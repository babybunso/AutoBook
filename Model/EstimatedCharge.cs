using System;

namespace Digify
{
    class EstimatedCharge : BaseRate
    {
        public EstimatedCharge(double oneHour, double fourHour, double eightHour, double twelveHour,
            double sixteenHour, double twentyHour, double twentyFourHour)
            : base(oneHour, fourHour, eightHour, twelveHour, sixteenHour, twentyHour, twentyFourHour) 
        {
            // ctor
        }
    }
}