using System;
using System.Collections.Generic;

namespace Digify
{
    class Test
    {
        static Dictionary<long, Car> Cars;
        static Dictionary<long, Partner> Partners;

        public static void Main()
        {
            Geo geo = new Geo(121.5, 16.5);
            Address address = new Address("street", "second street", "city", "state provice",
                    "country", "country code", 1120, geo);            
            People people = new People(1, "Rodel", "Arenas", address, "rodel.arenas@digify.com.ph", 
            "avatar/string/goeshere", 599);
            

            
            DataStore data = new DataStore(people);
            Cars = data.GetCars();
            Partners = data.GetPartners();

            PrintCars();
            //PrintPartners();
        }


        private static void PrintCars()
        {
            Console.WriteLine();
            foreach (long key in Cars.Keys)
            {
                Car car = Cars[key];
                Console.WriteLine("ID: " + car.Id + ", MODEL: " + car.Info.Model
                    + ", MILEAGE: " + car.Mileage + ", IDV: " + car.IDV 
                    + ", RATE(1 hr): " + car.GetRate().OneHour
                    + ", RATE(24 hrs): " + car.GetRate().TwentyFourHour
                    + ", BOND(1 hr): " + car.GetBond().OneHour
                    + ", BOND(24 hrs): " + car.GetBond().TwentyFourHour
                    + ", EST CHRG(1 hr): " + car.GetEstimatedCharge().OneHour
                    + ", EST CHRG(24 hrs): " + car.GetEstimatedCharge().TwentyFourHour);
            }
            Console.WriteLine("TOTAL CARS: " + Cars.Count);
        }

        private static void PrintPartners()
        {
            Console.WriteLine();
            foreach (long key in Partners.Keys)
            {
                Partner partner = Partners[key];
                Console.WriteLine("ID: " + partner.Id + ", NAME: " + partner.Name);                
            }
            Console.WriteLine("TOTAL PARTNERS: " + Partners.Count);
        }
    }
}