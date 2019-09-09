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
input int      LostSize=-100;
input int      ProfitSize=100;
input string   TradeBy="limit";
enum iTrend {Auto=0, Buy=1, Sell=2,MinTrend=3};
input iTrend StartTrend=0;
//+------------------------------------------------------------------+
//| BB Defiend                                  |
//+------------------------------------------------------------------+
double bbUpper, bbMinder, bbLower,bbUpperLast, bbMinderLast, bbLowerLast,bbUpperLastTow, bbMinderLastTow, bbLowerLastTow, QueryActive;
double bbUpper2, bbMinder2, bbLower2,bbUpperLast2, bbMinderLast2, bbLowerLast2,bbUpperLastTow2, bbMinderLastTow2, bbLowerLastTow2;

double SARValue;

double Ask, Bid, AskQuery, BidQuery;
string singal = "N/A";
uint totals, TaskNumber=1, TaskActive=0;

ulong active_id;
double active_price,active_profit, active_swap;
string active_type;

ulong orderTicket;
int getOrderType;
double orderPrice;

string Trend="auto";
int SellTask = 0, BuyTask=0;
//+------------------------------------------------------------------+
//| Expert initialization function                                   |
//+------------------------------------------------------------------+
int OnInit()
  {
//--- create timer
   
   
   if(StartTrend == 1){
      Trend = "buy";
   }
   
   if(StartTrend == 2){
      Trend = "sell";
   }
   if(StartTrend == 3){
      Trend = "auto";
   }
   
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
  
   double AccountBanlance = AccountInfoDouble(ACCOUNT_BALANCE);
   double AccountProfit = AccountInfoDouble(ACCOUNT_PROFIT);
   double AccountEntry = AccountInfoDouble(ACCOUNT_EQUITY);
   
   Ask = NormalizeDouble(SymbolInfoDouble(_Symbol,SYMBOL_ASK),_Digits);
   Bid = NormalizeDouble(SymbolInfoDouble(_Symbol,SYMBOL_BID),_Digits);
   
   
   totals = PositionsTotal();
   if(TaskNumber < totals){
      TaskNumber = totals;
      TaskActive = TaskNumber -1;
   }
   
//---
   ReadBB();
   ReadSAR();
   MakeQuery();
   TraiLingStop();
   OrderQuery();
   MutileTask();
   Comment("Balance :", AccountBanlance, " Entry : ", AccountEntry, " Profit : ", AccountProfit,
   "\nTrend : ",Trend," - Query Singal : ", singal,
   "\nActive Task : ", TaskActive, " Task Number : ", TaskNumber,
   "\nSAR : ", SARValue, " Buy Task : ", BuyTask, " Sell Task : ", SellTask
   );
  }
//+------------------------------------------------------------------+
//| Timer function                                                   |
//+------------------------------------------------------------------+
void OnTimer()
  {
//---
   
  }
//+------------------------------------------------------------------+
//| Trade function                                                   |
//+------------------------------------------------------------------+
void OnTrade()
  {
//---
   
  }
//+------------------------------------------------------------------+
//| TradeTransaction function                                        |
//+------------------------------------------------------------------+
void OnTradeTransaction(const MqlTradeTransaction& trans,
                        const MqlTradeRequest& request,
                        const MqlTradeResult& result)
  {
//---
   
  }
//+------------------------------------------------------------------+

void ReadBB(){
   double bbArrayUpper[], bbArrayMinder[], bbArrayLower[];
   ArraySetAsSeries(bbArrayUpper, true);
   ArraySetAsSeries(bbArrayMinder, true);
   ArraySetAsSeries(bbArrayLower, true);
   int BollingerBandsDefition = iBands(_Symbol, _Period, 20, 0, 2, PRICE_CLOSE);
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


void ReadBB2(){
   double bbArrayUpper[], bbArrayMinder[], bbArrayLower[];
   ArraySetAsSeries(bbArrayUpper, true);
   ArraySetAsSeries(bbArrayMinder, true);
   ArraySetAsSeries(bbArrayLower, true);
   int BollingerBandsDefition = iBands(_Symbol, PERIOD_M15, 20, 0, 2, PRICE_CLOSE);
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

void ReadSAR(){
   double mSARArray[];
   ArraySetAsSeries(mSARArray, true);
   int SARDefition = iSAR(_Symbol, _Period,0.02, 0.2);
   CopyBuffer(SARDefition, 0, 0, 3, mSARArray);
   SARValue = NormalizeDouble(mSARArray[0], _Digits);
   
}


void MakeQuery(){
   if(StartTrend == 0){
      ReadBB2();
      if(Ask > bbMinder2 + (50 * _Point)){
         Trend = "sell";
      }
      
      if(Bid < bbMinder2 - (50 * _Point)){
         Trend = "buy";
      }
   }
   
   if(QueryActive != bbUpperLast){
      
      /*
      if(bbMinderLast > bbMinder && bbMinderLastTow > bbMinderLast){
         singal = "sell"; 
      }
      
      if(bbMinderLastTow < bbMinderLast && bbMinderLast < bbMinder){
         singal = "buy"; 
      }
      */
      if(Bid > bbMinder || Ask > bbMinder){
         singal = "sell";
      }
      if(Bid < bbMinder || Ask < bbMinder){
         singal = "buy";
      }
      
      if(OrdersTotal() > 0){
            if(OrderGetTicket(0) > 0){
               orderTicket = OrderGetTicket(0);
               getOrderType = (int)OrderGetInteger(ORDER_TYPE);
               orderPrice = OrderGetDouble(ORDER_PRICE_OPEN);
               trade.OrderDelete(orderTicket);
               
            }
            
            if(OrderGetTicket(1) > 0){
               orderTicket = OrderGetTicket(1);
               getOrderType = (int)OrderGetInteger(ORDER_TYPE);
               orderPrice = OrderGetDouble(ORDER_PRICE_OPEN);
               trade.OrderDelete(orderTicket);
               
            }
            
      }else{
         orderTicket = 0;
         getOrderType = 0;
         orderPrice = 0.00;
      }
      
      QueryActive = bbUpperLast;
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
      
      if(totals < TaskNumber && OrdersTotal() == 0){
         if(Trend == "auto" || Trend == "sell"){
            if(singal == "sell"){
               trade.SellLimit(TradeSize,BidQuery,NULL,0,0,ORDER_TIME_GTC,0,"Sell Limit");
               //trade.BuyLimit(TradeSize,AskQuery,NULL,AskQuery - (3000 * _Point),AskQuery + (ProfitSize * _Point),ORDER_TIME_GTC,0,"Buy Limit");
            }
         }
         
         if(Trend == "auto" || Trend == "buy"){
            if(singal == "buy"){
               trade.BuyLimit(TradeSize,AskQuery,NULL,0,0,ORDER_TIME_GTC,0,"Buy Limit");
               //trade.SellLimit(TradeSize,BidQuery,NULL,BidQuery + (3000 * _Point),BidQuery - (ProfitSize * _Point),ORDER_TIME_GTC,0,"Sell Limit");
            }
         }
      }
   }
   
   if(TradeBy == "market"){
      if(totals < TaskNumber){
         
         if(Trend == "auto" || Trend == "sell"){
            if(singal == "sell"){
               trade.Sell(TradeSize,_Symbol,Bid,0,0,"Markets");
               //trade.Buy(TradeSize,_Symbol,Ask,Ask - (3000 * _Point),Ask + (500 * _Point),"Markets");
            }
         }
         
         
         if(Trend == "auto" || Trend == "buy"){
            if(singal == "buy"){
               trade.Buy(TradeSize,_Symbol,Ask,0,0,"Markets");
               //trade.Sell(TradeSize,_Symbol,Bid,Bid + (3000 * _Point),Bid - (500 * _Point),"Markets");
            }
         }
      }
   }
}

void TraiLingStop(){
 BuyTask = 0;
 SellTask = 0;
 double AskStopLost = NormalizeDouble(Ask - 50 * _Point, _Digits);
 double BidStopLost = NormalizeDouble(Bid + 50 * _Point, _Digits);
 
 for(uint i = 0; i<= totals; i++){
   string getSymbol = PositionGetSymbol(i);
   if(_Symbol == getSymbol){
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
         if(CurentStoplost < AskStopLost && CurentProfix > 0){
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
         if(CurentStoplost > BidStopLost && CurentProfix > 0){
            double MoveSL = (CurentStoplost - (10*_Point));
            if(CurentStoplost > CurentPrices){
               MoveSL = CurentPrices - (10*_Point); 
            }
            
            trade.PositionModify(PostionTicket, MoveSL,bbLower2);
         }
      }
      
   }
 }
 
}


void MutileTask(){
   if(TaskActive > 0 && TaskNumber > totals){
         if(m_position.SelectByIndex(TaskActive - 1)){
         
            
            
            if((m_position.PositionType() == POSITION_TYPE_SELL && Ask < m_position.PriceOpen() + (MoveSize * _Point)) || (m_position.PositionType() == POSITION_TYPE_BUY && Bid > m_position.PriceOpen()  - (MoveSize * _Point))){
               
                  
                  TaskNumber = TaskNumber - 1;
                  TaskActive = TaskActive - 1;
               
            }
               
         }
         
      }
   
   if(m_position.SelectByIndex(TaskActive)){
         if((m_position.PositionType() == POSITION_TYPE_SELL && Ask > m_position.PriceOpen() + (MoveSize * _Point)) || (m_position.PositionType() == POSITION_TYPE_BUY && Bid < m_position.PriceOpen()  - (MoveSize * _Point))){
            
               if(TaskNumber < 50){
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