using System;

namespace Digify
{
    public abstract class BaseRate
    {
        public double OneHour {get; set;}
        public double FourHour {get; set;}
        public double EightHour {get; set;}
        public double TwelveHour {get; set;}
        public double SixteenHour {get; set;}
        public double TwentyHour {get; set;}
        public double TwentyFourHour {get; set;}


        public BaseRate(double oneHour, double fourHour, double eightHour, double twelveHour,
            double sixteenHour, double twentyHour, double twentyFourHour)
        {
            this.OneHour = oneHour;
            this.FourHour = fourHour;
            this.EightHour = eightHour;
            this.TwelveHour = twelveHour;
            this.SixteenHour = sixteenHour;
            this.TwelveHour = twentyHour;
            this.TwentyFourHour = twentyFourHour;

        }
    }

}