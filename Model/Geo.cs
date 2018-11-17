using System;

namespace Digify
{
    class Geo
    {
        public double Latitude {get; set;}
        public double Longitude {get; set;}

        public Geo(double latitude, double longitude)
        {
            this.Latitude = latitude;
            this.Longitude = longitude;
        }
    }
}