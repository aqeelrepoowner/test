using System;
using System.Reflection;
using System.Collections.Generic;

namespace OOPs
{
    interface IEntityManager
    {
        Connection DBConnection { get;set; }
        List<KeyValuePair<string, object>> Entity { get; }
    }

    class Connection
    {
        
    }

    class EntityManager : IEntityManager
    {
        public static List<KeyValuePair<string, object>> fetchEntities = new List<KeyValuePair<string, object>>();
        private Connection connect;

        public Connection DBConnection
        {
            get { return connect; }
            set { connect = value; }
        }

        public List<KeyValuePair<string, object>> Entity
        {
            get { return fetchEntities; }
        }

        public EntityManager(params string[] entities)
        {
            Assembly assembly = Assembly.GetExecutingAssembly();

            foreach (string entity in entities)
            {
                fetchEntities.Add(new KeyValuePair<string, object>(entity, assembly.CreateInstance("OOPs."+entity)));
                //Console.WriteLine("each assembly object {0}",assembly.CreateInstance("OOPs."+entity));
            }
        }
    }



    interface IBugs
    {
        long Id { get; set; }
        string Title { get; set; }
        string Description { get; set; }
        Users Engineer { get; set; }
        Users Reporter { get; set; }
        DateTime CreatedOn { get; set; }
    }

    class Bugs : IBugs
    {       
        protected long id;
        protected string title;
        protected string description;
        protected Users engineer;
        protected Users reporter;
        protected DateTime created;

        public long Id
        {
            get { return id; }
            set { id = value; }
        }

        public string Title
        {
            get { return title; }
            set { title = value; }
        }

        public string Description
        {
            get { return description; }
            set { description = value; }
        }

        public Users Engineer
        {
            get { return engineer; }
            set { engineer = value; }
        }

        public Users Reporter
        {
            get { return reporter; }
            set { reporter = value; }
        }
        
        public DateTime CreatedOn
        {
            get { return created; }
            set { created = value; }
        }
    }

    class Users
    {
        protected int id;
        protected string name;
        protected string type;
        protected DateTime created;
        protected Bugs[] reportedBugs;
    }

    class UsefulObjects
    {
        public static List<KeyValuePair<string, object>> bugs = new List<KeyValuePair<string, object>>();

        public static void Main(string[] args)
        {            
            /*bugs.Add(new KeyValuePair<string, object>("bugs", new Bugs()));
            
            foreach (var element in bugs)
            {
                Console.WriteLine(element);
            }
            */
            object handler;
            EntityManager em = new EntityManager("Bugs", "Users");
            
            foreach (KeyValuePair<string,object> element in em.Entity)
            {
                Console.WriteLine(element.Value);
                if (element.Key == "Bugs") {
                    handler = new BugHandler(element.Value);
                    break;
                } elseif(element.Key == "Users") {
                    handler = new UsersHandler(element.Value);
                    break;
                }
            }

            Console.WriteLine("Handler Object :- {0}", handler);
            
            /*foreach(var prop in em.fetchEntities.GetType().GetProperties()) {
                    Console.WriteLine("{0}={1}", prop.Name);
            }*/
           /* var y = IsNamespaceExists(namespace);
            var x = IsClassExists(@class)? new @class : null; //Check if exists, instantiate if so.
            var z = x.IsMethodExists(method);*/
            

           // UsefulObjects u[] = new UsefulObjects[];
           
        }
        
    }

    class BugHandler
    {
        private Bugs handlerEntity;

        public BugHandler(Bugs bugEntity)
        {
            this.handlerEntity = bugEntity;
        }


    }

    class UsersHandler
    {
        private Users handlerEntity;

        public UsersHandler(Users userEntity)
        {
            this.handlerEntity = userEntity;
        }
    }   
}