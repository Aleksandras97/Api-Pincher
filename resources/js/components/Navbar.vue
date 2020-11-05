<template>
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
</template>

<script>
    export default {
        
    }
</script>