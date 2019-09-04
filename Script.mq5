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
input int FixTrend = 50;
double Bid, Ask, BidQuery, AskQuery;
ulong active_id;
double active_price,active_profit;
string active_type;

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
   
   if(Trend == "buy"){
      BidQuery = Bid;
      AskQuery = Ask - FixTrend;
   }else if(Trend == "sell"){
      BidQuery = Bid - FixTrend;
      AskQuery = Ask;
   }else{
      BidQuery = Bid;
      AskQuery = Ask;
   }
   if(BidQuery > bbUpperH1){
      
      if(m_position.SelectByIndex(taskActive)){
         if(m_position.PositionType() == POSITION_TYPE_BUY && m_position.Profit() > 0.5){
            trade.PositionClose(m_position.Ticket());
         }
      }
      if(total < taskNumber){
         trade.Sell(TradeSize, NULL, Bid,NULL,bbMiderH1, NULL);
      }
   }
   
   if(AskQuery < bbLowerH1){
      
      if(m_position.SelectByIndex(taskActive)){
         if(m_position.PositionType() == POSITION_TYPE_SELL && m_position.Profit() > 0.5){
            trade.PositionClose(m_position.Ticket());
         }
      }
      if(total < taskNumber){
         trade.Buy(TradeSize, NULL, Ask,NULL,bbMiderH1, NULL);
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
    }
    
    
   Comment("ID : ", active_id, " ", active_type, " : ", active_price, " Profit : ", active_profit);
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
