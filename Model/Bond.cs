using System;

namespace Digify
{
    class Bond : BaseRate
    {
        public Bond(double oneHour, double fourHour, double eightHour, double twelveHour,
            double sixteenHour, double twentyHour, double twentyFourHour)
            : base(oneHour, fourHour, eightHour, twelveHour, sixteenHour, twentyHour, twentyFourHour) 
        {
            // ctor
        }
    }
}