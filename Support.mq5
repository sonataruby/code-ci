//+------------------------------------------------------------------+
//|                                                       Montum.mq5 |
//|                        Copyright 2019, MetaQuotes Software Corp. |
//|                                             https://www.mql5.com |
//+------------------------------------------------------------------+
#property copyright "Copyright 2019, MetaQuotes Software Corp."
#property link      "https://www.mql5.com"
#property version   "1.00"
#include<Trade/Trade.mqh>
#include<Trade/PositionInfo.mqh>
CTrade trade;
CPositionInfo m_position;
input double TradeSize=0.01;
input string Trend = "auto";
input int MoveSize = 200;
input int LostSize = -100;
input int FixTrend = 20;
input int ProfixSize = 100;
input string TradeBy = "market";

double Bid, Ask, BidQuery, AskQuery;
ulong active_id;
double active_price,active_profit, active_swap;
string active_type;
double ActiveClosePrice;

int taskActive=0;
int taskNumber = 1;
ulong orderTicket;
int getOrderType;
double orderPrice;
//+------------------------------------------------------------------+
//| Expert initialization function                                   |
//+------------------------------------------------------------------+
int OnInit()
  {
//--- create timer
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
  
 
  
//---
   double AccountBanlance = AccountInfoDouble(ACCOUNT_BALANCE);
   double AccountProfit = AccountInfoDouble(ACCOUNT_PROFIT);
   double AccountEntry = AccountInfoDouble(ACCOUNT_EQUITY);
   
   Ask = NormalizeDouble(SymbolInfoDouble(_Symbol,SYMBOL_ASK),_Digits);
   Bid = NormalizeDouble(SymbolInfoDouble(_Symbol,SYMBOL_BID),_Digits);
   
   uint total = PositionsTotal();
   if(taskNumber < total){
      taskNumber = total;
      taskActive = taskNumber -1;
   }
   double UpperBandArray_h1[];
   double LowerBandArray_h1[];
   double MidBandArray_h1[];
   double bbUpperH1;
   double bbLowerH1;
   double bbMiderH1;
   
   double bbUpperLast;
   double bbLowerLast;
   double bbMiderLast;
   
   double bbUpperLast1;
   double bbLowerLast1;
   double bbMiderLast1;
   
   
   double bbUpperLast2;
   double bbLowerLast2;
   double bbMiderLast2;
   
   
   ArraySetAsSeries(UpperBandArray_h1, true);
   ArraySetAsSeries(LowerBandArray_h1, true);
   ArraySetAsSeries(MidBandArray_h1, true);
   int BollingerBandsDefition_h1 = iBands(_Symbol, _Period, 20, 0, 2, PRICE_CLOSE);
   CopyBuffer(BollingerBandsDefition_h1, 1, 0, 4, UpperBandArray_h1);
   CopyBuffer(BollingerBandsDefition_h1, 2, 0, 4, LowerBandArray_h1);
   CopyBuffer(BollingerBandsDefition_h1, 0, 0, 4, MidBandArray_h1);
   
   bbUpperH1 = NormalizeDouble(UpperBandArray_h1[0], _Digits);
   bbLowerH1 = NormalizeDouble(LowerBandArray_h1[0], _Digits);
   bbMiderH1 = NormalizeDouble(MidBandArray_h1[0], _Digits);
   
   bbUpperLast = NormalizeDouble(UpperBandArray_h1[1], _Digits);
   bbLowerLast = NormalizeDouble(LowerBandArray_h1[1], _Digits);
   bbMiderLast = NormalizeDouble(MidBandArray_h1[1], _Digits);

   bbUpperLast1 = NormalizeDouble(UpperBandArray_h1[2], _Digits);
   bbLowerLast1 = NormalizeDouble(LowerBandArray_h1[2], _Digits);
   bbMiderLast1 = NormalizeDouble(MidBandArray_h1[2], _Digits);
   
   bbUpperLast2 = NormalizeDouble(UpperBandArray_h1[3], _Digits);
   bbLowerLast2 = NormalizeDouble(LowerBandArray_h1[3], _Digits);
   bbMiderLast2 = NormalizeDouble(MidBandArray_h1[3], _Digits);
      
   
   /*
   Read Price
   */
   MqlRates PriceInfomation[];
   ArraySetAsSeries(PriceInfomation, true);
   int Data = CopyRates(_Symbol, _Period, 0, Bars(_Symbol, _Period), PriceInfomation);
   double closePrice = PriceInfomation[1].close;
   double closePrice1 = PriceInfomation[2].close;
   
   /*
     double traddingRand = 0;
     int HeightestCandle, LowestCandle;
     double Height[], Low[];
     ArraySetAsSeries(Height, true);
     ArraySetAsSeries(Low, true);
     CopyHigh(_Symbol, _Period, 0, 100, Height);
     CopyLow(_Symbol, _Period, 0, 100, Low);
     HeightestCandle = ArrayMaximum(Height, 0, 100);
     LowestCandle = ArrayMinimum(Low, 0, 100);
      ObjectCreate(_Symbol, "High",OBJ_HLINE, 0, 0,PriceInfomation[HeightestCandle].high);
      ObjectSetInteger(0,"High", OBJPROP_COLOR, clrAqua);
      ObjectSetInteger(0,"High", OBJPROP_WIDTH, 3);
      ObjectMove(_Symbol, "High", 0, 0,PriceInfomation[HeightestCandle].high);
      
      ObjectCreate(_Symbol, "Low",OBJ_HLINE, 0, 0,PriceInfomation[HeightestCandle].low);
      ObjectSetInteger(0,"Low", OBJPROP_COLOR, clrAqua);
      ObjectSetInteger(0,"Low", OBJPROP_WIDTH, 3);
      ObjectMove(_Symbol, "Low", 0, 0,PriceInfomation[HeightestCandle].low);
      
   */
   
   BidQuery = bbUpperH1 + (FixTrend * _Point);
   AskQuery = bbLowerH1 - (FixTrend * _Point);
   if(Bid > bbUpperH1){
      BidQuery = Bid + (FixTrend * _Point);
   }
   
   if(Ask < bbLowerH1){
      AskQuery = Ask - (FixTrend * _Point);
   }
   
   
   
   string singal = "N/A";
   
   if(Ask > bbMiderH1){
      singal = "sell";
   }else if(Ask < bbMiderH1){
      singal = "buy";
   }
   
   
   if(ActiveClosePrice != bbMiderLast){
   /*Close Task limit*/
      if(OrdersTotal() > 0){
            if(OrderGetTicket(0) > 0){
               orderTicket = OrderGetTicket(0);
               getOrderType = OrderGetInteger(ORDER_TYPE);
               orderPrice = OrderGetDouble(ORDER_PRICE_OPEN);
               trade.OrderDelete(orderTicket);
               
            }
      }else{
         orderTicket = 0;
         getOrderType = 0;
         orderPrice = 0.00;
      }
      
      if(singal == "sell"){
         
         if(OrdersTotal() == 0 && total < taskNumber){
            trade.SellLimit(TradeSize,BidQuery,NULL,NULL,BidQuery - (ProfixSize * _Point),ORDER_TIME_GTC,0,0);
         }
      }
      if(singal == "buy"){
         
         if(OrdersTotal() == 0 && total < taskNumber){
            trade.BuyLimit(TradeSize,AskQuery,NULL,NULL,AskQuery + (ProfixSize * _Point),ORDER_TIME_GTC,0,0);
         }
      }
   }
   
   
   if(taskActive > 0 && taskNumber > total){
         if(m_position.SelectByIndex(taskActive - 1)){
         
            
            
            if((m_position.PositionType() == POSITION_TYPE_SELL && Ask < m_position.PriceOpen() + (MoveSize * _Point)) || (m_position.PositionType() == POSITION_TYPE_BUY && Bid > m_position.PriceOpen()  - (MoveSize * _Point))){
               
                  
                  taskNumber = taskNumber - 1;
                  taskActive = taskActive - 1;
               
            }
               
         }
         
      }
   
   if(m_position.SelectByIndex(taskActive)){
         if((m_position.PositionType() == POSITION_TYPE_SELL && Ask > m_position.PriceOpen() + (MoveSize * _Point)) || (m_position.PositionType() == POSITION_TYPE_BUY && Bid < m_position.PriceOpen()  - (MoveSize * _Point))){
            
               if(taskNumber < 50){
                  taskNumber = taskNumber + 1;
                  taskActive = taskActive + 1;
               }
            
         }
         
         active_id=m_position.Identifier();
         active_price= m_position.PriceOpen();
         active_type = m_position.PositionType() == POSITION_TYPE_BUY ? "[BUY]" : "[SELL]";
         active_profit=m_position.Profit();
         active_swap = m_position.Swap();
    }
    
   ActiveClosePrice = bbMiderLast;
   Comment("ID : ", active_id, " ", active_type, " : ", active_price, " Profit : ", active_profit, " Swap : ", active_swap,
      "\nClose BB : ", bbMiderLast, " Ative Close : ", ActiveClosePrice,
      "\nOrder Ticket : ",orderTicket, " Order Type : ", getOrderType, " Order Price : ", orderPrice);
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
