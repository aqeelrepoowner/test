using System;
using System.Text;

namespace string_function
{
    class Program
    {
        static string[] _items = new string[]
        {
            "cat",
            "dog",
            "giraffe"
        };

        static void Main(string[] args)
        {
        string firstname;
        string lastname;
        
        
        firstname = "Steven Clark";
        lastname = "Clark";
 
        string str = "mystring";
        string newString = str.Substring(3, 1);
        Console.WriteLine(newString);
        Console.WriteLine(str);
        Console.WriteLine();
        Console.WriteLine("=======Clone String======");
        /*Clone*/
        string[] array = { "C#", "VB", "ASP.Net" };
        string[] cloned = array.Clone() as string[];

        Console.WriteLine(string.Join(",", array));
        Console.WriteLine(string.Join(",", cloned));
      

        // Change the first element in the cloned array.
        cloned[0] = "element";

        Console.WriteLine(string.Join(",", array));
        Console.WriteLine(string.Join(",", cloned));

 Console.WriteLine("=======Compare to======");
        string a = "a";
        string b = "b";

        int c = string.Compare(a, b);
        Console.WriteLine(c);

        c = string.CompareOrdinal(b, a);
        Console.WriteLine(c);

        c = a.CompareTo(b);
        Console.WriteLine(c);

        c = b.CompareTo(a);
        Console.WriteLine(c);

        
//Compare two string value and returns 0 for true and
//1 for false
 
 Console.WriteLine(firstname.Contains("ven")); //Check whether specified value exists or not in string
 
 Console.WriteLine(firstname.EndsWith("n")); //Check whether specified value is the last character of string
 Console.WriteLine(firstname.Equals(lastname));
//Compare two string and returns true and false
 
 
  Console.WriteLine(firstname.GetHashCode());
//Returns HashCode of String
 
  Console.WriteLine(firstname.GetType());
//Returns type of string
 
  Console.WriteLine(firstname.GetTypeCode());
//Returns type of string
 
  Console.WriteLine(firstname.IndexOf("e")); //Returns the first index position of specified value the first index position of specified value
 
  Console.WriteLine(firstname.ToLower());
//Covert string into lower case
 
  Console.WriteLine(firstname.ToUpper());
//Convert string into Upper case
 
  Console.WriteLine("=====Insert======="); //Insert substring into string
        string names = "Romeo Juliet";
        string shakespeare = names.Insert(6, "and ");
        Console.WriteLine(shakespeare);

        //
        // B. You can insert a string right after another string.
        //
        string names2 = "The Taming of Shrew";
        int index2 = names2.IndexOf("of ");
        string shakespeare2 = names2.Insert(index2 + "of ".Length, "the ");
        Console.WriteLine(shakespeare2);

  Console.WriteLine("=====Insert End======="); //Insert substring into string
  Console.WriteLine(firstname.IsNormalized());
//Check Whether string is in Unicode normalization
//from C
 
 
 Console.WriteLine(firstname.LastIndexOf("e")); //Returns the last index position of specified value
 
 Console.WriteLine(firstname.Length);
//Returns the Length of String
 
 Console.WriteLine(firstname.Remove(5));
//Deletes all the characters from begining to specified index.
 
 Console.WriteLine(firstname.Replace('e','i')); // Replace the character
 
  Console.WriteLine("=====Split======");
  string[] split = firstname.Split(new char[] { 'a','e', 'i', 'o', 'u' }); //Split the string based on specified value
 
 
            Console.WriteLine(split[0]);
            Console.WriteLine(split[1]);
            Console.WriteLine(split[2]);
 
  Console.WriteLine(firstname.StartsWith("S")); //Check wheter first character of string is same as specified value
 
  Console.WriteLine(firstname.Substring(2,5));
//Returns substring
 
  Console.WriteLine(firstname.ToCharArray());
//Converts an string into char array.
 
  Console.WriteLine(firstname.Trim());
//It removes starting and ending white spaces from string.

        StringBuilder builder1 = new StringBuilder();
        // Append to StringBuilder.
        for (int i = 0; i < 10; i++)
        {
            builder1.Append(i).Append(" ");
        }
        builder1.Append("Aqueel");
        builder1.AppendLine();
        builder1.ToString(0, 4);
        builder1.Append("The list starts here:");
        builder1.AppendLine();
        builder1.Append("1 cat").AppendLine();
        Console.WriteLine(builder1.ToString());


        /* Replace :- String builder*/
        StringBuilder builder2 = new StringBuilder("This is an example string that is an example.");

        builder2.Replace("an", "the"); // Replaces 'an' with 'the'.
        Console.WriteLine(builder2.ToString());

          /* AppendFormat Example */
        StringBuilder builder = new StringBuilder();
        string[] data = { "Pimpri", "Pune Airport", "Delhi Airport", "Connaught Place" };
        int counter = 0;
        foreach (string value in data)
        {
            builder.AppendFormat("You have visited {0} ({1}).\n",
                value,
                ++counter);
        }
        Console.WriteLine(builder);

        //
        // Create two StringBuilders with the same contents.
        //
        StringBuilder b1 = new StringBuilder();
        b1.Append("One ");
        b1.Append("two");

        StringBuilder b2 = new StringBuilder();
        b2.Append("One ");
        b2.Append("two");
        b2.Append("three");
        //
        // See if the StringBuilder contents are equal.
        //
        
        if (b1.Equals(b2))
        {
            Console.WriteLine("Equal");
        } 
        else 
        {
            Console.WriteLine("Before Clear:"+b1.ToString());
            b1.Clear();
            Console.WriteLine("Clear string:"+b1.ToString() + " '' and String length becomes zero:" + b1.Length);
            Console.WriteLine("I found that Clear simply assigns the Length property to zero internally.");
        }

        if (b1 == b2)
        {
            Console.WriteLine("Equals");
        }

    

/*
*/
           
        }

        

    }
}