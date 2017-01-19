using System;
using System.Drawing;

namespace arrays
{
    class Arrays
    {
        /*Single Dimensional Arrays*/
        public int[] setArr1D = new int[50];   

        public int[] array1 = new int[5];  
        // Declare and set array element values
        public int[] array2 = new int[] { 1, 3, 5, 7, 9 };
        // Alternative syntax
        public int[] array3 = { 1, 2, 3, 4, 5, 6 };

         // Two-dimensional array.
        public int[,] setArr2Dor3D = new int[10,1];  

        public int[,] array2D = new int[,] { { 1, 2 }, { 3, 4 }, { 5, 6 }, { 7, 8 } };
        // The same array with dimensions specified.
        public int[,] array2Da = new int[4, 2] { { 1, 2 }, { 3, 4 }, { 5, 6 }, { 7, 8 } };
        // A similar array with string elements.
        public string[,] array2Db = new string[3, 2] { { "one", "two" }, { "three", "four" },
                                                { "five", "six" } };

        // Three-dimensional array.
        public int[, ,] array3D = new int[,,] { { { 1, 2, 3 }, { 4, 5, 6 } }, 
                                        { { 7, 8, 9 }, { 10, 11, 12 } } };
        // The same array with dimensions specified.
        public int[, ,] array3Da = new int[2, 3, 3] { 
                                { { 1, 2, 3 }, { 4, 5, 6 }, { 1, 2, 3 } }, 
                                { { 7, 8, 9 }, { 10, 11, 12 }, { 1, 2, 3 } } 
                            };

        public void printSingleDimensionalArray()
        {  
            Console.WriteLine("Single Dimensional Array:-");
            for(int i = 0;i < array2.Length;i++)
            {   
                Console.WriteLine("{0}\n", array2[i]);
            } 
        }   

        public void setSingleDimensionalArray()
        {
            for (int i = 0;i < 50;i++)
            {
                setArr1D[i] = i;
            }
            Console.WriteLine("Single Dimensional set and get");
            for(int i = 0;i < setArr1D.Length;i++)
            {   
                Console.WriteLine("{0}\n", setArr1D[i]);
            } 
        }

        public void setMultiDimensionalArray()
        {
          
            for (int i = 0;i < 10;i++)
            {
                 for (int j = 0;j < 1;j++)
                 {
                    setArr2Dor3D[i, j] = i + 100;
                 }
            }
               Console.WriteLine("Multi Dimensional set and get");
            for(int i = 0;i < 10;i++)
            { 
                 for (int j = 0;j < 1;j++)
                 {
                    Console.WriteLine("{0}\n", setArr2Dor3D[i, j]);
                 }
            } 
        }

        public void printMultiDimensionalArray()
        {
            Console.WriteLine("Multi 2D-3D Dimensional Array:-");                                    
            // Accessing array elements.
            Console.WriteLine(array2D[0, 0]);
            Console.WriteLine(array2D[0, 1]);
            Console.WriteLine(array2D[1, 0]);
            Console.WriteLine(array2D[1, 1]);
            Console.WriteLine(array2D[3, 0]);
            Console.WriteLine(array2Db[1, 0]);
            Console.WriteLine(array3Da[1, 0, 1]);
            Console.WriteLine(array3D[1, 1, 2]);

            // Getting the total count of elements or the length of a given dimension.
            var allLength = array3D.Length;
            var total = 1;
            for (int i = 0; i < array3D.Rank; i++) {
                /*Get length of array in specified dimension*/
                total *= array3D.GetLength(i);
            }
            Console.WriteLine("{0} equals {1}", allLength, total);

            Console.WriteLine(array3Da[1, 0, 1]);

        }
    }

   class MainClass
   {
        static void Main(string[] args)
        {
            Arrays a = new Arrays();
           /* a.setSingleDimensionalArray();
            a.setMultiDimensionalArray();
            a.printSingleDimensionalArray();
            a.printMultiDimensionalArray();*/

             //Initializing and storing value in arr1
            int[] arr1 = new int[5] { 43, 25, 33, 14, 5 };
            int[] arr2 = new int[5];
            int len;
 
            //Check array length
            len = arr1.Length;
            Console.WriteLine("Length:\t{0}", len);
 
            //Sorting an array
            Array.Sort(arr1);
            printarray(arr1);
            /*Array.Reverse(arr1);
            printarray(arr1);*/
 
            //Returning Lenght from specified position
            Console.WriteLine("\nGet Length:\t{0}", arr1.GetLength(0));
 
            //Returns value of specified position
            Console.WriteLine("\nGet Value:\t{0}", arr1.GetValue(2));
 
            //Returns Index position of specified value
            Console.WriteLine("\nGet Index:\t{0}", Array.IndexOf(arr1, 25));
 
            //Copying arr1's items to arr2
            Array.Copy(arr1, arr2, 5);
            printarray(arr2);
 
            //Removing items from array.
            Array.Clear(arr1, 0, 5);
            printarray(arr1);
 

            // Find the names containing any character
            string[] names = { "akeel", "Pravin", "Suyog" };
            string match = Array.Find(names, ContainsA);
        
            Console.WriteLine("\nSingle Matched name is : -{0}",match);
            string[] matches = Array.FindAll(names, ContainsA);

            Console.WriteLine("\nMulti matches are");
            foreach(string mtch in matches) {
                    Console.WriteLine("\nMatched name is : -{0}",mtch);
            }

          

            Console.ReadLine();
            
        }

        static bool ContainsA (string name) 
        {
             return name.Contains("a");      
        }

        static void printarray(int[] arr)
        {
            Console.WriteLine("\nElements of array is:\n");
            foreach (int i in arr)
            {
                Console.Write("\t{0}", i);
            }
        }
   }

}
