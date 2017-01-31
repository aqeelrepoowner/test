using System;
using System.Collections.Generic;

public class CollectionsExample
{
    public static void Main()
    {
        List<string> cars = new List<string>();

        Console.WriteLine("\nCapacity: {0}", cars.Capacity);

        cars.Add("BMW X1");
        cars.Add("BMW X3");
        cars.Add("BMW X5");
        cars.Add("Audi Q2");
        cars.Add("Audi Q3");
        cars.Add("Audi Q5");
        Console.WriteLine();

        foreach(string car in cars)
        {
            Console.WriteLine(car);
        }

        Console.WriteLine("\nCapacity: {0}", cars.Capacity);
        Console.WriteLine("Count: {0}", cars.Count);

        Console.WriteLine("\nContains(\"BMW X1\"): {0}",
        cars.Contains("BMW X1"));

        Console.WriteLine("\nInsert(2, \"BMW X3\")");
        cars.Insert(2, "BMW X6");

        Console.WriteLine();

        foreach(string car in cars)
        {
            Console.WriteLine(car);
        }

        // Shows accessing the list using the Item property.
        Console.WriteLine("\ncars[3]: {0}", cars[3]);

        Console.WriteLine("\nRemove(\"Audi Q5\")");
        cars.Remove("Audi Q5");

        Console.WriteLine();

        foreach(string car in cars)
        {
            Console.WriteLine(car);
        }

        cars.TrimExcess();
        Console.WriteLine("\nTrimExcess()");
        Console.WriteLine("Capacity: {0}", cars.Capacity);
        Console.WriteLine("Count: {0}", cars.Count);

        cars.Clear();
        Console.WriteLine("\nClear()");
        Console.WriteLine("Capacity: {0}", cars.Capacity);
        Console.WriteLine("Count: {0}", cars.Count);
    }
}