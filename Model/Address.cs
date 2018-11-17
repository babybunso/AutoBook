using System;

namespace Digify
{
    class Address
    {
        public string Street {get; set;}
        public string SecondStreet {get; set;}
        public string City {get; set;}
        public string StateProvince {get; set;}
        public string Country {get; set;}
        public string CountryCode {get; set;}
        public long ZipCode {get; set;}

        public Geo Geo {get; set;}

        public Address(string street, string secondStreet, string city, string stateProvince, 
            string country, string countryCode, long zipCode, Geo geo)
        {
            this.Street = street;
            this.SecondStreet = secondStreet;
            this.City = city;
            this.StateProvince = stateProvince;
            this.Country = country;
            this.CountryCode = countryCode;
            this.ZipCode = zipCode;
            this.Geo = geo;
        }
    }
}