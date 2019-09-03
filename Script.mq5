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
double Bid, Ask;
int taskActive=0;
int taskNumber = 1;
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
   
   double iMomentumArray[];
   
   ArraySetAsSeries(iMomentumArray, true);
   
   double Momentum = iMomentum(_Symbol, _Period,8, PRICE_CLOSE);
   
   CopyBuffer(Momentum, 0, 0, 3, iMomentumArray);
   
   double MomentumLever = NormalizeDouble(iMomentumArray[0],2);
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
   
   ArraySetAsSeries(UpperBandArray_h1, true);
   ArraySetAsSeries(LowerBandArray_h1, true);
   ArraySetAsSeries(MidBandArray_h1, true);
   int BollingerBandsDefition_h1 = iBands(_Symbol, _Period, 20, 0, 2, PRICE_CLOSE);
   CopyBuffer(BollingerBandsDefition_h1, 1, 0, 3, UpperBandArray_h1);
   CopyBuffer(BollingerBandsDefition_h1, 2, 0, 3, LowerBandArray_h1);
   CopyBuffer(BollingerBandsDefition_h1, 0, 0, 3, MidBandArray_h1);
   
   bbUpperH1 = NormalizeDouble(UpperBandArray_h1[0], _Digits);
   bbLowerH1 = NormalizeDouble(LowerBandArray_h1[0], _Digits);
   bbMiderH1 = NormalizeDouble(MidBandArray_h1[0], _Digits);
   
   
   if(Bid > bbUpperH1){
      
      if(m_position.SelectByIndex(taskActive)){
         if(m_position.PositionType() == POSITION_TYPE_BUY && m_position.Profit() > 0.5){
            trade.PositionClose(m_position.Ticket());
         }
      }
      if(total < taskNumber){
         trade.Sell(0.1, NULL, Bid,NULL,bbMiderH1, NULL);
      }
   }
   
   if(Ask < bbLowerH1){
      
      if(m_position.SelectByIndex(taskActive)){
         if(m_position.PositionType() == POSITION_TYPE_SELL && m_position.Profit() > 0.5){
            trade.PositionClose(m_position.Ticket());
         }
      }
      if(total < taskNumber){
         trade.Buy(0.1, NULL, Ask,NULL,bbMiderH1, NULL);
      }
   }
   
   
   if(taskActive > 0 && taskNumber > total){
         if(m_position.SelectByIndex(taskActive - 1)){
         
            
            
            if((m_position.PositionType() == POSITION_TYPE_SELL && Ask < m_position.PriceOpen() + (200 * _Point)) || (m_position.PositionType() == POSITION_TYPE_BUY && Bid > m_position.PriceOpen()  - (200 * _Point))){
               
                  
                  taskNumber = taskNumber - 1;
                  taskActive = taskActive - 1;
               
            }
               
         }
         
      }
   
   if(m_position.SelectByIndex(taskActive)){
         
    
     
      if((m_position.PositionType() == POSITION_TYPE_SELL && Ask > m_position.PriceOpen() + (200 * _Point)) || (m_position.PositionType() == POSITION_TYPE_BUY && Bid < m_position.PriceOpen()  - (200 * _Point))){
         
            if(taskNumber < 50){
               taskNumber = taskNumber + 1;
               taskActive = taskActive + 1;
            }
         
      }
         
 }
   Comment("Momentum : ", MomentumLever);
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
