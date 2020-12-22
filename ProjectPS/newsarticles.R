library(tm.plugin.webmining)
library(devtools)
library(tm)

symbols = list("MSFT", "AAPL", "GOOG", "AMZN", "FB", "TWTR", "TSLA", "IBM", "YHOO", "NFLX")

for (i in 1:length(symbols))
{
  stock <- WebCorpus(YahooFinanceSource(symbol))
  writeCorpus(stock, path = paste0("NewsArticles/",symbols[i]), filenames = paste(seq_along(stock),symbols[i]," 07-08", sep = ""))
  print('succesfull')
}

# AMZN <- WebCorpus(YahooFinanceSource("AMZN"))
# writeCorpus(AMZN, path = "NewsArticles/AMZN", filenames = paste(seq_along(AMZN),"AMZN 07-08", sep = ""))