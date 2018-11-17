using System;

namespace Digify
{
    class Partner
    {
        public long Id {get; set;}
        public string Name {get; set;}
        public string Description {get; set;}

        public Address Address {get; set;}
        public string Email {get; set;}
        public double Ranking {get; set;}

        public Partner(long id, string name, string description, Address address, 
            string email, double ranking)
        {   
            this.Id = id;
            this.Name = name;
            this.Description = description;
            this.Address = address;
            this.Email = email;
            this.Ranking = ranking;
        }
    }

}