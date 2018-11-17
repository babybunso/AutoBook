using System;
using System.Collections.Generic;

namespace Digify
{
    class DataStore
    {
        private Dictionary<long, Car> Cars = new Dictionary<long, Car>();
        private Dictionary<long, Partner> Partners = new Dictionary<long, Partner>();
        private Random random = new Random();
        private People People;
        public DataStore(People people)
        {
            this.People = people;

            PopulateCars(100);
            PopulatePartners(100);
        }

        public Dictionary<long, Partner> GetPartners()
        {
            return this.Partners;
        }

        public Dictionary<long, Car> GetCars()
        {
            return this.Cars;
        }

        private void PopulateCars(int count)
        {
            Car car = null;
            long id = -1;

            for (int i = 0; i < count; i++)
            {
                id = i + 1;
                int rand = random.Next(FakesUtil.Types.Length - 1);
                string type = FakesUtil.Types[rand];
                string model = FakesUtil.Models[rand];
                double idv = FakesUtil.IDVs[rand];
                double mileage = FakesUtil.Mileages[rand];

                // TODO - Geo
                Geo geo = new Geo(121.5, 16.5);
                Address address = new Address("street", "second street", "city", "state provice",
                    "country", "country code", 1000 + i, geo);            
                CarInfo info = new CarInfo(model, type, "XY1234", "Car description blah blah blah", random.Next(5) + 1);
                car = new Car(id, info, address, this.People, idv, mileage);
                this.Cars.Add(id, car);
            }
        }

        private void PopulatePartners(int count)
        {
            Partner partner = null;
            long id = -1;

            for (int i = 0; i < count; i++)
            {
                id = i + 1;

                // TODO - Geo
                Geo geo = new Geo(121.0, 16.0);
                Address address = new Address("street", "second street", "city", "state provice",
                    "country", "country code", 1000 + i, geo);
                partner = new Partner(id, "Partner Name_" + id, "Partner Description", address, 
                    "partner_" + id + "@gmail.com", random.Next(5)+1);

                this.Partners.Add(id, partner);
            }
        }
    }
}