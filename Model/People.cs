using System;

namespace Digify
{
    class People
    {
        public long Id {get; set;}
        public string Firstname {get; set;}
        public string Lastname {get; set;}

        public Address Address {get; set;}
        public string Email {get; set;}
        public string Avatar {get; set;}
        public int Score {get; set;}

        public People(long id, string firstname, string lastname, Address address, 
            string email, string avatar, int score)
        {   
            this.Id = id;
            this.Firstname = firstname;
            this.Lastname = lastname;
            this.Address = address;
            this.Email = email;
            this.Avatar = avatar;
            this.Score = score;
        }
    }
}