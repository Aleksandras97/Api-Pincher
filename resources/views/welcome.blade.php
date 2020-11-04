<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Pincher</title>  

        <link rel="stylesheet" href="/css/main.css">
        <script src="/js/app.js" defer></script>
    </head>
    <body class="text-gray-600 font-body">
        <div id="app">
            <!-- <example-component foo="bar"></example-component> -->

             <div class="grid md:grid-cols-3"> <!-- Content wrapper -->

                <div class="md:col-span-1 md:flex md:justify-end"> <!-- Start nav -->
                    <nav>
                        <div class="flex justify-between items-center">
                            <h1 class="font-bold uppercase p-4 border-b border-gray-100">
                                <a href="/">Pincher</a>
                            </h1>
                            <div class="p-4 md:hidden">
                                Menu
                            </div>
                        </div>

                        <ul class="text-xl mt-6 hidden md:block">
                            <li class="text-gray-700 font-bold py-1 px-6 md:border-l-4 md:border-green-600">
                                <a href="#">
                                    <span>Home</span>
                                </a>
                            </li>

                            <li class= "py-1 px-6 md:border-l-4 md:border-white">
                                <a href="#">
                                    <span>Profile</span>
                                </a>
                            </li>

                        </ul>

                    </nav> 
                </div> <!-- End nav -->

                <main class="py-6 md:col-span-2" style="max-width: 700px">

                    <div class="pb-4 flex justify-center md:justify-end">
                        <a href="#" class="btn text-white bg-green-500 ">Log in</a>
                        <a href="#" class="btn text-white  bg-green-500 ml-2">Sign up</a>
                    </div>
                

                    <div>
                        
                        <div class="border-2 border-green-300 rounded-lg px-8 py-4">

                            <form action="">
                                <textarea name="body" class="w-full" placeholder="Post!"></textarea>
                                <hr class="my-4">

                            </form>
                            
                            <footer class="flex justify-between">
                                <img src="https://i.pravatar.cc/40" alt="avatar" class="rounded-full">

                                <button type="submit" class="btn bg-green-500 rounded-lg shadow-lg p-2 text-white">Punch!!</button>
                            </footer>

                        </div>

                        <h4 class="font-bold text-gray-700 text-xl my-6 pb-2 border-b border-gray-200">Latests Posts</h4>


                        <div class="border border-gray-300 rounded-lg">

                            <!-- posts -->
                            <div class="flex p-4 shadow-md border-b border-b-gray-300">
                                <div class="mr-4 flex-shrink-0">
                                    <img src="https://i.pravatar.cc/50" alt="avatar" class="rounded-full">
                                </div>
                                <div>
                                    <h5 class="font-bold mb-4">Aleksandras</h5>
                                    
                                    <p class="text-sm">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Provident facilis dolorem quibusdam sapiente beatae, maiores asperiores, voluptas officia nihil magni dolor inventore nulla voluptate? Sunt sequi consequuntur blanditiis? Quisquam, ratione.</p>
                                </div>
                            </div>

                            <div class="flex p-4 bg-white rounded shadow-md">
                                <div class="mr-4 flex-shrink-0">
                                    <img src="https://i.pravatar.cc/50" alt="avatar" class="rounded-full">
                                </div>
                                <div>
                                    <h5 class="font-bold mb-4">Aleksandras</h5>
                                    
                                    <p class="text-sm">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Provident facilis dolorem quibusdam sapiente beatae, maiores asperiores, voluptas officia nihil magni dolor inventore nulla voluptate? Sunt sequi consequuntur blanditiis? Quisquam, ratione.</p>
                                </div>
                            </div>

                            
                        </div>


                    </div>
                </main>

               
             </div>
    </body>
</html>
