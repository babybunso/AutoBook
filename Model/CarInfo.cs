using System;
namespace Digify
{
    class CarInfo
    {
        public string Model {get; set;}
        public string Type {get; set;}
        public string PlateNumber {get; set;}
        public string Description {get; set;}
        public double Ranking {get; set;}
  
        public CarInfo(string model, string type, string plateNumber, string description, double ranking)
        {
            this.Model = model;
            this.Type = type;
            this.PlateNumber = plateNumber;
            this.Description = description;
            this.Ranking = ranking;
        }
    }
}