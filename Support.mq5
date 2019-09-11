//+------------------------------------------------------------------+
//|                                                      Support.mq5 |
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
input double   TradeSize=0.1;
input double CloseProfit = 0;
input double CloseProfitSize = 0.01;
input string BigTrend = "on";
double bbUpper, bbMinder, bbLower,bbUpperLast, bbMinderLast, bbLowerLast,bbUpperLastTow, bbMinderLastTow, bbLowerLastTow, QueryActive;

int SpanceSize = 10;
int BlockScreen = 0;
string CloseTrend = " Not active";
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
   
   double Ask = NormalizeDouble(SymbolInfoDouble(_Symbol,SYMBOL_ASK),_Digits);
   double Bid = NormalizeDouble(SymbolInfoDouble(_Symbol,SYMBOL_BID),_Digits);
   double BidQuery = Bid - (SpanceSize * _Point);
   double AskQuery = Ask + (SpanceSize * _Point);
   
   if(CloseProfit > 0){
      for(int i=0; i<= PositionsTotal(); i++){
         if(m_position.SelectByIndex(i)){
            if(m_position.Profit() > CloseProfit && m_position.Volume() == CloseProfitSize){
               trade.PositionClose(m_position.Ticket());
               
            }
           
         }
      }
      CloseTrend = "Active Close";
   }
   ReadBB();
   if(BlockScreen == 0 && BigTrend == "on"){
      if(BidQuery > bbUpper){
         trade.Sell(TradeSize,_Symbol,Bid,0,0,"Big Trader");
         BlockScreen = 1;
      }
      
      if(AskQuery < bbLower){
         trade.Buy(TradeSize,_Symbol,Ask,0,0,"Big Trader");
         BlockScreen = 1;
      }
   }
   
   Comment("BB Upper : ", bbUpper, " - BB Lower : ", bbLower,
   "\nAsk : ", Ask, " - Bid : ", Bid, " Ask Query : ", AskQuery, " - Bid Query : ", BidQuery,
   "\nLock Screen : ", (BlockScreen == 0 ? "Wait" : "Block"),
   "\nClose Profit : ", CloseProfit, " $"," Size : ",CloseProfitSize," [lot] - Close Trend : ", CloseTrend
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