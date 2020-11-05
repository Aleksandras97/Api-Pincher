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
            <!-- <home></home> -->

             <div class="grid md:grid-cols-3"> <!-- Content wrapper -->


                <div class="md:col-span-1 md:flex md:justify-end"> <!-- Start nav -->
                
                    <navbar></navbar>

                </div> <!-- End nav -->

                <main class="py-6 md:col-span-2" style="max-width: 700px">

                    <div class="pb-4 flex justify-center md:justify-end">
                        <a href="#" class="btn text-white bg-green-500 ">Log in</a>
                        <a href="#" class="btn text-white  bg-green-500 ml-2">Sign up</a>
                    </div>


                    <div>
                        
                        <!-- WritePost -->
                        <write-post></write-post>
                        
                        <!-- Time line -->
                        <Timeline><Timeline>


                    </div>


                </main>

               
             </div>
             <script src="/js/app.js"></script>
    </body>
</html>
