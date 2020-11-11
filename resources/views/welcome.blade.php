<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Pincher</title>  

        <link rel="stylesheet" href="/css/main.css">
        
    </head>
    <body class="text-gray-600 font-body">
        <div id="app">

        <div class="grid md:grid-cols-3"> 

            <Navbar></Navbar>
            
            <main class=" px-4 md:col-span-2" style="max-width: 650px">

            <div class="p-3 flex justify-center md:justify-end md:border-r md:border-l  border-gray-500">
                <router-link class="btn hover:bg-teal-900" :to="{ name: 'Login'}" >Log in</router-link>
                <router-link class="btn hover:bg-teal-900 mx-2" :to="{ name: 'Register'}" >Sign up</router-link>
            </div>

            <div class="md:border md:border-gray-500 shadow-2xl bg-white lg:mx-0">

                <router-view></router-view>
                
            </div>
            


        </main>
                    

            

        </div>

        </div>
        <script src="/js/app.js"></script>
    </body>
</html>
