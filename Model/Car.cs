using System;

namespace Digify
{
    class Car : IRatingSystem
    {   
        public long Id {get; set;}
        public CarInfo Info {get; set;}
        public Address Address {get; set;}
        public double Score {get; set;}

        public double IDV {get; set;}
        public double Mileage {get; set;}

        private double baseRate;
        private double mileageDiscount;
        private double baseBondRate;
        private double meanScore;


        public Car(long id, CarInfo info, Address address, People people, double idv, double mileage)
        {
            this.Id = id;
            this.Info = info;
            this.Address = address;
            this.Score = people.Score;
            this.IDV = idv;
            this.Mileage = mileage;

            // precompute
            this.baseRate = IDV * 0.0015;
            this.baseBondRate = 5; // five petot
            this.mileageDiscount = (this.Mileage / 1000) * this.baseBondRate;
            this.meanScore = 600;
        }

        public Rate GetRate()
        {
            double hourlyRate = baseRate - mileageDiscount;
            double rate4 = hourlyRate * 4 - 50;
            double rate8 = hourlyRate * 8 - 75;
            double rate12 = hourlyRate * 12 - 100;
            double rate16 = hourlyRate * 16 - 125;
            double rate20 = hourlyRate * 20 - 150;
            double rate24 = hourlyRate * 24 - 175;
            
            Rate rate = new Rate(hourlyRate, rate4, rate8, rate12, rate16, rate20, rate24);
            return rate;
        }

        public Bond GetBond()
        {
            double hourlyRate = baseRate - mileageDiscount;
            double rate4 = hourlyRate * 4 - 50;
            double rate8 = hourlyRate * 8 - 75;
            double rate12 = hourlyRate * 12 - 100;
            double rate16 = hourlyRate * 16 - 125;
            double rate20 = hourlyRate * 20 - 150;
            double rate24 = hourlyRate * 24 - 175;

            double meanScoreRate = this.meanScore / this.Score;
            double scoreRate1 = (meanScoreRate > 1)  ? hourlyRate * meanScoreRate : hourlyRate;
            double scoreRate4 = (meanScoreRate > 1)  ? rate4 * meanScoreRate : rate4;
            double scoreRate8 = (meanScoreRate > 1)  ? rate8 * meanScoreRate : rate8;
            double scoreRate12 = (meanScoreRate > 1)  ? rate12 * meanScoreRate : rate12;
            double scoreRate16 = (meanScoreRate > 1) ? rate16 * meanScoreRate : rate16;
            double scoreRate20 = (meanScoreRate > 1)  ? rate20 * meanScoreRate : rate20;
            double scoreRate24 = (meanScoreRate > 1)  ? rate24 * meanScoreRate : rate24;

            double bond1 = scoreRate1 - hourlyRate;
            double bond4 = scoreRate4 - rate4;
            double bond8 = scoreRate8 - rate8;
            double bond12 = scoreRate12 - rate12;
            double bond16 = scoreRate16 - rate16;
            double bond20 = scoreRate20 - rate20;
            double bond24 = scoreRate24 - rate24;

            Bond bond = new Bond(bond1, bond4, bond8, bond12, bond16, bond20, bond24);

            return bond;
        }

        public EstimatedCharge GetEstimatedCharge()
        {
            double hourlyRate = baseRate - mileageDiscount;
            double rate4 = hourlyRate * 4 - 50;
            double rate8 = hourlyRate * 8 - 75;
            double rate12 = hourlyRate * 12 - 100;
            double rate16 = hourlyRate * 16 - 125;
            double rate20 = hourlyRate * 20 - 150;
            double rate24 = hourlyRate * 24 - 175;

            double meanScoreRate = this.meanScore / this.Score;
            double estimate1 = (meanScoreRate > 1) ? hourlyRate * meanScoreRate : hourlyRate;
            double estimate4 = (meanScoreRate > 1) ? rate4 * meanScoreRate : rate4;
            double estimate8 = (meanScoreRate > 1)  ? rate8 * meanScoreRate : rate8;
            double estimate12 = (meanScoreRate > 1)  ? rate12 * meanScoreRate : rate12;
            double estimate16 = (meanScoreRate > 1)  ? rate16 * meanScoreRate : rate16;
            double estimate20 = (meanScoreRate > 1)  ? rate20 * meanScoreRate : rate20;
            double estimate24 = (meanScoreRate > 1)  ? rate24 * meanScoreRate : rate24;
            
            EstimatedCharge charge = new EstimatedCharge(estimate1, estimate4, estimate8, estimate12,
                estimate16, estimate20, estimate24);
            return charge;
        }
    }
}