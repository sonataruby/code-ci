//+------------------------------------------------------------------+
//|                                                     AITrader.mq5 |
//|  Copyright 2019, MetaQuotes Software Corp. Develop by VO VAN KHO |
//|                                             https://www.mql5.com |
//+------------------------------------------------------------------+
#property copyright "Copyright 2019, MetaQuotes Software Corp. Develop by VO VAN KHO"
#property link      "https://www.mql5.com"
#property version   "1.00"

#include<Trade/Trade.mqh>
#include<Trade/PositionInfo.mqh>
CTrade trade;
CPositionInfo m_position;

//--- input parameters
input double   TradeSize=0.01;

input int      MoveSize=200;
input int      SpanceSize=20;
input int      ProfitSize=100;
input int      MoveStartSize=50;
input int      StopLostProfit = -100;
input string SwitchTrend = "up";

string   TradeBy="limit";
enum iTradeBy {Limit=0, Markets=1};
input iTradeBy StartTradeBy=0;

enum iTrend {Auto=0, Buy=1, Sell=2,MinTrend=3};
input iTrend StartTrend=3;

enum iTrendFream {M1=0, M3=1, M5=2};
input iTrendFream StartFream=0;

input double   Comisstion=0.1;
ulong PostionTicketActive, PostionTicketLast;
//+------------------------------------------------------------------+
//| BB Defiend                                  |
//+------------------------------------------------------------------+
double bbUpper, bbMinder, bbLower,bbUpperLast, bbMinderLast, bbLowerLast,bbUpperLastTow, bbMinderLastTow, bbLowerLastTow, QueryActive;
double bbUpper2, bbMinder2, bbLower2,bbUpperLast2, bbMinderLast2, bbLowerLast2,bbUpperLastTow2, bbMinderLastTow2, bbLowerLastTow2;
double bbUpperH1, bbMinderH1, bbLowerH1,bbUpperLastH1, bbMinderLastH1, bbLowerLastH1,bbUpperLastTowH1, bbMinderLastTowH1, bbLowerLastTowH1;
double bbUpperH4, bbMinderH4, bbLowerH4,bbUpperLastH4, bbMinderLastH4, bbLowerLastH4,bbUpperLastTowH4, bbMinderLastTowH4, bbLowerLastTowH4;

double SARValue;

double Ask, Bid, AskQuery, BidQuery;
string singal = "N/A";
uint totals, TaskNumber=1, TaskActive=0;

ulong active_id;
double active_price,active_profit, active_swap;
string active_type;

ulong orderTicket, orderTicketActive;
int getOrderType;
double orderPrice;

string Trend="auto";
int SellTask = 0, BuyTask=0;
ENUM_TIMEFRAMES TimeFream = 1;

string MagicTrend = "N/A";
string MagicTrendFocus = "N/A";
string iSymbol;
int OrderTotal = 0;
//+------------------------------------------------------------------+
//| Expert initialization function                                   |
//+------------------------------------------------------------------+
int OnInit()
  {
//--- create timer
   iSymbol = _Symbol;
   
   EventSetTimer(60);
   
//---
   return(INIT_SUCCEEDED);
  }
//+------------------------------------------------------------------+
//| Expert deinitialization function                                 |
//+------------------------------------------------------------------+
void OnDeinit(const int reason)
  {
//--- destroy timer
   EventKillTimer();
   
  }
//+------------------------------------------------------------------+
//| Expert tick function                                             |
//+------------------------------------------------------------------+
void OnTick()
  {
   
   InstallINT();
   double AccountBanlance = AccountInfoDouble(ACCOUNT_BALANCE);
   double AccountProfit = AccountInfoDouble(ACCOUNT_PROFIT);
   double AccountEntry = AccountInfoDouble(ACCOUNT_EQUITY);
   
   Ask = NormalizeDouble(SymbolInfoDouble(iSymbol,SYMBOL_ASK),_Digits);
   Bid = NormalizeDouble(SymbolInfoDouble(iSymbol,SYMBOL_BID),_Digits);
   
   
   //totals = PositionsTotal();
   if(TaskNumber < totals){
      TaskNumber = totals;
      TaskActive = TaskNumber -1;
   }
   if(TaskNumber > totals + 1){
      TaskNumber = totals;
      TaskActive = TaskNumber -1;
   }
   
//---
   ReadBB();
   ReadSAR();
   TraiLingStart();
   TraiLingStop();
   OrderQuery();
   MutileTask();
   
         
   Comment("Symbol : ",iSymbol," TimeFream : ",TimeFream," Version : 1.2.2",
   "\nBalance :", AccountBanlance, " Entry : ", AccountEntry, " Profit : ", AccountProfit,
   "\nTrade By : ", TradeBy, " Trend : ",Trend," - Query Singal : ", singal,
   "\nMagic Trend : ", MagicTrend, " Focus Trend : ", MagicTrendFocus,
   "\nTaskActive ID : ", PostionTicketActive, " Last Task ID : ",PostionTicketLast, " Order Active ID : ", orderTicketActive, " Order Total ", OrderTotal, "Sum Order", OrdersTotal(),
   "\nActive Task : ", TaskActive, " Task Number : ", TaskNumber, " Total : ", totals,
   "\nTrailing Stop: ", MoveStartSize, " Trailing Start : ", SpanceSize,
   "\nSAR : ", SARValue, " Buy Task : ", BuyTask, " Sell Task : ", SellTask
   );
  }

void InstallINT(){
   MagicTrend = "N/A";
   MagicTrendFocus = "N/A";
   if(StartTrend == 1){
      Trend = "buy";
   }
   
   if(StartTrend == 2){
      Trend = "sell";
   }
   if(StartTrend == 3){
      Trend = "auto";
   }
   
   if(StartFream == 0){
      TimeFream = PERIOD_M1;
   }
   
   if(StartFream == 1){
      TimeFream = PERIOD_M3;
   }
   
   if(StartFream == 2){
      TimeFream = PERIOD_M5;
   }
   
   if(StartTradeBy == 0){
      TradeBy = "limit";
   }
   if(StartTradeBy == 1){
      TradeBy = "market";
   }
   
   PostionTicketActive = 0; 
   PostionTicketLast = 0;
   totals = 0;
   int ii = 0;
   if(PositionsTotal() > 0){
      for(int i = PositionsTotal() - 1; i >= 0; i--){
         string getSymbol = PositionGetSymbol(i);
         if(iSymbol == getSymbol){
            if(ii == 0){
               PostionTicketActive = PositionGetInteger(POSITION_TICKET);
            }
            if(ii == 1){
               PostionTicketLast = PositionGetInteger(POSITION_TICKET);
            }
            totals = totals + 1;
            ii = ii + 1;
         }else{
            ii = 0;
         }
      }
   }
   
   if(totals == 1){
      PostionTicketLast = PostionTicketActive;
   }
   
   if(PostionTicketLast > 0 && m_position.SelectByTicket(PostionTicketLast)){
         
         if((m_position.PositionType() == POSITION_TYPE_SELL && Ask < m_position.PriceOpen() + (MoveSize * _Point)) || (m_position.PositionType() == POSITION_TYPE_BUY && Bid > m_position.PriceOpen()  - (MoveSize * _Point))){
            
               
               TaskNumber = TaskNumber - 1;
               TaskActive = TaskActive - 1;
            
         } 
   }
   orderTicketActive = 0;
   OrderTotal = 0;
   for(int i=OrdersTotal()-1; i >=0; i--){
      ulong orderTicket2 = OrderGetTicket(i);
      string getSymbol = OrderGetString(ORDER_SYMBOL);
      if(orderTicketActive == 0 && iSymbol == getSymbol){
         orderTicketActive = orderTicket2;
         OrderTotal = OrderTotal + 1;
      }
   }
}


void ReadBB(){
   double bbArrayUpper[], bbArrayMinder[], bbArrayLower[];
   ArraySetAsSeries(bbArrayUpper, true);
   ArraySetAsSeries(bbArrayMinder, true);
   ArraySetAsSeries(bbArrayLower, true);
   int BollingerBandsDefition = iBands(iSymbol, TimeFream, 20, 0, 2, PRICE_CLOSE);
   CopyBuffer(BollingerBandsDefition, 1, 0, 4, bbArrayUpper);
   CopyBuffer(BollingerBandsDefition, 2, 0, 4, bbArrayLower);
   CopyBuffer(BollingerBandsDefition, 0, 0, 4, bbArrayMinder);
   
   bbUpper = NormalizeDouble(bbArrayUpper[0], _Digits);
   bbLower = NormalizeDouble(bbArrayLower[0], _Digits);
   bbMinder = NormalizeDouble(bbArrayMinder[0], _Digits);
   
   
   bbUpperLast = NormalizeDouble(bbArrayUpper[1], _Digits);
   bbLowerLast = NormalizeDouble(bbArrayLower[1], _Digits);
   bbMinderLast = NormalizeDouble(bbArrayMinder[1], _Digits);
   
   bbUpperLastTow = NormalizeDouble(bbArrayUpper[2], _Digits);
   bbLowerLastTow = NormalizeDouble(bbArrayLower[2], _Digits);
   bbMinderLastTow = NormalizeDouble(bbArrayMinder[2], _Digits);
   
}



void ReadSAR(){
   double mSARArray[];
   ArraySetAsSeries(mSARArray, true);
   int SARDefition = iSAR(iSymbol, TimeFream,0.02, 0.2);
   CopyBuffer(SARDefition, 0, 0, 3, mSARArray);
   SARValue = NormalizeDouble(mSARArray[0], _Digits);
   
}


void TraiLingStart(){
   if(StartTrend == 0){
      ReadBB2();
      
      if(Ask > bbMinder2 + (50 * _Point)){
         Trend = "sell";
      }
      
      if(Bid < bbMinder2 - (50 * _Point)){
         Trend = "buy";
      }
      
      if(bbMinderLast2 > bbMinder2 && bbMinderLastTow2 > bbMinderLast2){
         MagicTrend = "startdown"; 
      }
      
      if(bbMinderLastTow2 < bbMinderLast2 && bbMinderLast2 < bbMinder2){
         MagicTrend = "startup"; 
      }
      
   }
   
   /*
   Remove Order if Task Not Allow
   */
   if(TaskNumber == totals){
         trade.OrderDelete(orderTicketActive);
   }
   
   orderTicket = 0;
   getOrderType = 0;
   orderPrice = 0.00;
      
   
   
   if(QueryActive != bbUpperLast){
      
      
      
      
      if(Bid > bbMinder || Ask > bbMinder){
         singal = "sell";
      }
      if(Bid < bbMinder || Ask < bbMinder){
         singal = "buy";
      }
      
      
      
      
      BidQuery = bbUpper + (SpanceSize * _Point);
      AskQuery = bbLower - (SpanceSize * _Point);
      if(Ask < bbLower){
         AskQuery = Ask - (SpanceSize * _Point);
      }
      
      if(Bid > bbUpper){
         BidQuery = Bid + (SpanceSize * _Point);
      }
      
      
         
      
      
      if(OrderSelect(orderTicketActive)){
         getOrderType = (int)OrderGetInteger(ORDER_TYPE);
         orderPrice = OrderGetDouble(ORDER_PRICE_OPEN);
         if(OrderGetInteger(ORDER_TYPE) == ORDER_TYPE_BUY_LIMIT){
            if(Ask > bbMinder){
               trade.OrderDelete(orderTicketActive);
            }else{
               trade.OrderModify(orderTicketActive,AskQuery,0,0,ORDER_TIME_GTC,0,0);
            }
         }else if(OrderGetInteger(ORDER_TYPE) == ORDER_TYPE_SELL_LIMIT){
             if(Ask < bbMinder){
               trade.OrderDelete(orderTicketActive);
             }else{
               trade.OrderModify(orderTicketActive,AskQuery,0,0,ORDER_TIME_GTC,0,0);
             }
         }
      }
      
      
      QueryActive = bbUpperLast;
      
      
   }
   
   if(MagicTrend != "N/A" && SwitchTrend == "down"){
      if(MagicTrend == "startup"){
         singal = "buy";
         Trend = "buy";
      }
      if(MagicTrend == "startdown"){
         singal = "sell";
         Trend = "sell";
      }
   }
   
}


void OrderQuery(){
   
   BidQuery = Bid + (SpanceSize * _Point);
   AskQuery = Ask - (SpanceSize * _Point);
   
   
   if(TradeBy == "limit"){
      BidQuery = bbUpper + (SpanceSize * _Point);
      AskQuery = bbLower - (SpanceSize * _Point);
      if(Ask < bbLower){
         AskQuery = Ask - (SpanceSize * _Point);
      }
      
      if(Bid > bbUpper){
         BidQuery = Bid + (SpanceSize * _Point);
      }
      
      
   
      if(totals < TaskNumber && OrdersTotal() < 5){
         if(Trend == "auto" || Trend == "sell"){
            if(singal == "sell" && OrderTotal == 0){
               trade.SellLimit(TradeSize,BidQuery,NULL,0,0,ORDER_TIME_GTC,0,"Sell Limit");
               //trade.BuyLimit(TradeSize,AskQuery,NULL,AskQuery - (3000 * _Point),AskQuery + (ProfitSize * _Point),ORDER_TIME_GTC,0,"Buy Limit");
            }
         }
         
         if(Trend == "auto" || Trend == "buy"){
            if(singal == "buy" && OrderTotal == 0){
               trade.BuyLimit(TradeSize,AskQuery,NULL,0,0,ORDER_TIME_GTC,0,"Buy Limit");
               //trade.SellLimit(TradeSize,BidQuery,NULL,BidQuery + (3000 * _Point),BidQuery - (ProfitSize * _Point),ORDER_TIME_GTC,0,"Sell Limit");
            }
         }
      }
   }
   
   
   
   if(TradeBy == "market"){
      BidQuery = Bid - (SpanceSize * _Point);
      AskQuery = Ask + (SpanceSize * _Point);
      
      
      if(totals < TaskNumber){
         
         if(Trend == "auto" || Trend == "sell"){
            if(BidQuery > bbUpper){
               trade.Sell(TradeSize,iSymbol,Bid,0,0,"Markets");
               //trade.Buy(TradeSize,_Symbol,Ask,Ask - (3000 * _Point),Ask + (500 * _Point),"Markets");
            }
         }
         
         
         if(Trend == "auto" || Trend == "buy"){
            if(AskQuery < bbLower){
               trade.Buy(TradeSize,iSymbol,Ask,0,0,"Markets");
               //trade.Sell(TradeSize,_Symbol,Bid,Bid + (3000 * _Point),Bid - (500 * _Point),"Markets");
            }
         }
      }
   }
}

void TraiLingStop(){
 BuyTask = 0;
 SellTask = 0;
 double AskStopLost = NormalizeDouble(Ask - (MoveStartSize * _Point), _Digits);
 double BidStopLost = NormalizeDouble(Bid + (MoveStartSize * _Point), _Digits);
 
 for(int i = 0; i<= (int)PositionsTotal(); i++){
   string getSymbol = PositionGetSymbol(i);
   
   if(iSymbol == getSymbol){
      ulong PostionTicket = PositionGetInteger(POSITION_TICKET);
      double CurentStoplost = PositionGetDouble(POSITION_SL);
      int CurentType = (int)PositionGetInteger(POSITION_TYPE);
      double CurentProfix = PositionGetDouble(POSITION_PROFIT);
      double CurentPrices = PositionGetDouble(POSITION_PRICE_OPEN);
      
      if(CurentType == POSITION_TYPE_BUY){
         BuyTask = BuyTask + 1;
      }
      
      if(CurentType == POSITION_TYPE_SELL){
         SellTask = SellTask + 1;
      }
      
      if(CurentStoplost == 0){
         CurentStoplost = CurentPrices + (10*_Point);
      }      
      /*
      Move SL Buy
      */
      if(CurentType == POSITION_TYPE_BUY){
         if(CurentStoplost < AskStopLost && CurentProfix > Comisstion){
            double MoveSL = (CurentStoplost + (10*_Point));
            if(CurentStoplost < CurentPrices){
               MoveSL = CurentPrices + (10*_Point); 
            }
            trade.PositionModify(PostionTicket, MoveSL,bbUpper2);
         }
      }
      
      /*
      Move SL Sell
      */
      if(CurentType == POSITION_TYPE_SELL){
         if(CurentStoplost > BidStopLost && CurentProfix > Comisstion){
            double MoveSL = (CurentStoplost - (10*_Point));
            if(CurentStoplost > CurentPrices){
               MoveSL = CurentPrices - (10*_Point); 
            }
            
            trade.PositionModify(PostionTicket, MoveSL,bbLower2);
         }
      }
      if(MagicTrend != MagicTrendFocus){
         if(MagicTrend == "startup"){
            //Close All order Sell
            if(CurentType == POSITION_TYPE_SELL && CurentProfix < StopLostProfit){
               trade.PositionClose(PostionTicket);
            }
         }
         
         if(MagicTrend == "startdown"){
            //Close All order Buy
            if(CurentType == POSITION_TYPE_BUY && CurentProfix < StopLostProfit){
               trade.PositionClose(PostionTicket);
            }
         }
         
         MagicTrendFocus = MagicTrend;
      }
   }//end if
   
 }// End for
 
}


void MutileTask(){
   
   if(m_position.SelectByTicket(PostionTicketActive)){
         if((m_position.PositionType() == POSITION_TYPE_SELL && Ask > m_position.PriceOpen() + (MoveSize * _Point)) || (m_position.PositionType() == POSITION_TYPE_BUY && Bid < m_position.PriceOpen()  - (MoveSize * _Point))){
            
               if(TaskNumber < 50 && TaskNumber == totals){
                  TaskNumber = TaskNumber + 1;
                  TaskActive = TaskActive + 1;
               }
            
         }
         
         active_id=m_position.Identifier();
         active_price= m_position.PriceOpen();
         active_type = m_position.PositionType() == POSITION_TYPE_BUY ? "[BUY]" : "[SELL]";
         active_profit=m_position.Profit();
         active_swap = m_position.Swap();
    }
    
}



void ReadBB2(){
   double bbArrayUpper[], bbArrayMinder[], bbArrayLower[];
   ArraySetAsSeries(bbArrayUpper, true);
   ArraySetAsSeries(bbArrayMinder, true);
   ArraySetAsSeries(bbArrayLower, true);
   int BollingerBandsDefition = iBands(iSymbol, PERIOD_M15, 20, 0, 2, PRICE_CLOSE);
   CopyBuffer(BollingerBandsDefition, 1, 0, 4, bbArrayUpper);
   CopyBuffer(BollingerBandsDefition, 2, 0, 4, bbArrayLower);
   CopyBuffer(BollingerBandsDefition, 0, 0, 4, bbArrayMinder);
   
   bbUpper2 = NormalizeDouble(bbArrayUpper[0], _Digits);
   bbLower2 = NormalizeDouble(bbArrayLower[0], _Digits);
   bbMinder2 = NormalizeDouble(bbArrayMinder[0], _Digits);
   
   
   bbUpperLast2 = NormalizeDouble(bbArrayUpper[1], _Digits);
   bbLowerLast2 = NormalizeDouble(bbArrayLower[1], _Digits);
   bbMinderLast2 = NormalizeDouble(bbArrayMinder[1], _Digits);
   
   bbUpperLastTow2 = NormalizeDouble(bbArrayUpper[2], _Digits);
   bbLowerLastTow2 = NormalizeDouble(bbArrayLower[2], _Digits);
   bbMinderLastTow2 = NormalizeDouble(bbArrayMinder[2], _Digits);
   
}


void ReadBBH1(){
   double bbArrayUpper[], bbArrayMinder[], bbArrayLower[];
   ArraySetAsSeries(bbArrayUpper, true);
   ArraySetAsSeries(bbArrayMinder, true);
   ArraySetAsSeries(bbArrayLower, true);
   int BollingerBandsDefition = iBands(iSymbol, PERIOD_M15, 20, 0, 2, PRICE_CLOSE);
   CopyBuffer(BollingerBandsDefition, 1, 0, 4, bbArrayUpper);
   CopyBuffer(BollingerBandsDefition, 2, 0, 4, bbArrayLower);
   CopyBuffer(BollingerBandsDefition, 0, 0, 4, bbArrayMinder);
   
   bbUpperH1 = NormalizeDouble(bbArrayUpper[0], _Digits);
   bbLowerH1 = NormalizeDouble(bbArrayLower[0], _Digits);
   bbMinderH1 = NormalizeDouble(bbArrayMinder[0], _Digits);
   
   
   bbUpperLastH1 = NormalizeDouble(bbArrayUpper[1], _Digits);
   bbLowerLastH1 = NormalizeDouble(bbArrayLower[1], _Digits);
   bbMinderLastH1 = NormalizeDouble(bbArrayMinder[1], _Digits);
   
   bbUpperLastTowH1 = NormalizeDouble(bbArrayUpper[2], _Digits);
   bbLowerLastTowH1 = NormalizeDouble(bbArrayLower[2], _Digits);
   bbMinderLastTowH1 = NormalizeDouble(bbArrayMinder[2], _Digits);
   
}


void ReadBBH4(){
   double bbArrayUpper[], bbArrayMinder[], bbArrayLower[];
   ArraySetAsSeries(bbArrayUpper, true);
   ArraySetAsSeries(bbArrayMinder, true);
   ArraySetAsSeries(bbArrayLower, true);
   int BollingerBandsDefition = iBands(iSymbol, PERIOD_M15, 20, 0, 2, PRICE_CLOSE);
   CopyBuffer(BollingerBandsDefition, 1, 0, 4, bbArrayUpper);
   CopyBuffer(BollingerBandsDefition, 2, 0, 4, bbArrayLower);
   CopyBuffer(BollingerBandsDefition, 0, 0, 4, bbArrayMinder);
   
   bbUpperH4 = NormalizeDouble(bbArrayUpper[0], _Digits);
   bbLowerH4 = NormalizeDouble(bbArrayLower[0], _Digits);
   bbMinderH4 = NormalizeDouble(bbArrayMinder[0], _Digits);
   
   
   bbUpperLastH4 = NormalizeDouble(bbArrayUpper[1], _Digits);
   bbLowerLastH4 = NormalizeDouble(bbArrayLower[1], _Digits);
   bbMinderLastH4 = NormalizeDouble(bbArrayMinder[1], _Digits);
   
   bbUpperLastTowH4 = NormalizeDouble(bbArrayUpper[2], _Digits);
   bbLowerLastTowH4 = NormalizeDouble(bbArrayLower[2], _Digits);
   bbMinderLastTowH4 = NormalizeDouble(bbArrayMinder[2], _Digits);
   
}