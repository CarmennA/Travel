using Newtonsoft.Json;
using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace CountriesScriptGenerator
{
    class Program
    {
        static void Main(string[] args)
        {
            // read file into a string and deserialize JSON to a type
            List<Country> countries = JsonConvert.DeserializeObject<List<Country>>(File.ReadAllText(@"D:\apps\data\countries.json"));

            StringBuilder sb = new StringBuilder();
            foreach (var c in countries)
            {
                sb.AppendFormat("INSERT INTO countries(Name, Code) VALUES('{0}', '{1}');\n", c.Name, c.Code);
            }

            File.WriteAllText(@"D:\apps\data\countries.sql", sb.ToString());
        }
    }
}
