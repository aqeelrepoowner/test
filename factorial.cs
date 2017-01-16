using System;

public class Functions
{
    public static long Factorial(int n)
    {
        // Test for invalid input
        if ((n < 0) || (n > 20))
        {
            return -1;
        }

        // Calculate the factorial iteratively rather than recursively:
        long tempResult = 1;
        for (int i = 1; i <= n; i++)
        {
            tempResult *= i;
        }
        return tempResult;
    }
}

class MainClass
{
    static int Main(string[] args)
    {
        // Test if input arguments were supplied:
     /*   if (args.Length == 0)
        {
            System.Console.WriteLine("Please enter a numeric argument.");
            System.Console.WriteLine("Usage: Factorial <num>");
            return 1;
        }*/

        // Try to convert the input arguments to numbers. This will throw
        // an exception if the argument is not a number.
        // num = int.Parse(args[0]);
        int num;
        bool test = int.TryParse("15", out num);
        Console.WriteLine("test TryParse:" + test);
        if (test == false)
        {
            System.Console.WriteLine("Please enter a numeric argument.");
            System.Console.WriteLine("Usage: Factorial <num>");
            return 1; 
        }
        Double number;
        String value = "5.63";
        if (Double.TryParse(args[0], out number))
            Console.WriteLine(number);
        else
         Console.WriteLine("{0} is outside the range of a Double Or Incorrect format", 
                           args[0]);
        // Calculate factorial.
        long result = Functions.Factorial(num);

        // Print result.
        if (result == -1)
            System.Console.WriteLine("Input must be >= 0 and <= 20.");
        else
            System.Console.WriteLine("The Factorial of {0} is {1}.", num, result);

        return 0;
    }
}