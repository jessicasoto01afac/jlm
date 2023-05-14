<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>
<style>
    .contenedor_loader{
        background-color: #f3f3f3;
        position:fixed;
        width: 100vw;
        height: 100vh;
        z-index: 9999;
        transition: all 1.5s;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>

<body>
    <div  id="loader" name="loader" class="contenedor_loader hidden">
        <div class="absolute right-1/2 bottom-1/2  transform translate-x-1/2 translate-y-1/2 ">
        <div class="border-t-transparent border-solid animate-spin rounded-full border-blue-400 border-8 h-64 w-64"></div>
    </div>
    </div>
    <div class="bg-gray-300 ">
        <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
            <a class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
                <img src="views/template/img/logo.png" width="100" height="100">
                <span class="ml-3 text-xl">Jose Luis Mondragon</span>
            </a>
        </div>
    </div>
    <!-- component -->
    <div class="bg-gray-300">
        <div class="px-4 py-6">
            <div class="relative w-full md:max-w-2xl md:mx-auto text-center">

                <h1
                    class="text-2xl font-semibold text-center text-gray-800 capitalize lg:text-3xl dark:text-white mb-6">
                    Rastrea tu <span class="text-blue-500 ">pedido</span> aqui
                </h1>

                <div class="flex w-full justify-center items-end">
                    <div class="relative mr-4 lg:w-full xl:w-1/2 w-2/4 md:w-full text-left">
                        <label for="hero-field" class="leading-7 text-sm text-gray-600">Número de Rastreo</label>
                        <input type="text" id="hero-search" name="hero-search"
                            class="w-full bg-gray-100 bg-opacity-50 rounded focus:ring-2 focus:ring-indigo-200 focus:bg-transparent border border-gray-300 focus:border-indigo-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    </div>
                    <button type="button" onclick="searchpickup()" id="button" name="button"
                        class="inline-flex items-center py-2.5 px-3 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><svg
                            class="mr-2 -ml-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>Buscar</button>
                </div>
                <p id="text" name="text" class="text-sm mt-2 text-gray-800 mb-8 w-full">Ingresa el número de rastreo</p>
                <input type="text" class="hidden" id="status" name="status">
            </div>
        </div>

        <svg class="fill-current bg-gray-300 text-white hidden md:block" xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 1440 320">
            <path fill-opacity="1"
                d="M0,64L120,85.3C240,107,480,149,720,149.3C960,149,1200,107,1320,85.3L1440,64L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z">
            </path>
        </svg>
    </div>

    <!-- aqui show -->
    <div id="welcome" name="welcome">
        <div class="max-w-4xl mx-auto bg-white shadow-lg relative z-20 hidden md:block"
            style="margin-top: -320px; border-radius: 20px;">
            <section class="bg-white dark:bg-gray-900 px-6 py-6 mx-auto">
                <div class="container flex flex-col items-center px-4 py-12 mx-auto xl:flex-row">
                    <div class="flex justify-center xl:w-4/2">
                        <img class="h-20 w-20 sm:w-[18rem] sm:h-[18rem] flex-shrink-0 object-cover rounded-full"
                            src="https://img.freepik.com/foto-gratis/joven-mensajero-su-colega-descargando-cajas-carton-furgoneta-reparto_637285-2293.jpg?w=740&t=st=1683785584~exp=1683786184~hmac=9582d3cffdda8d3351f998cf52a0f8ee63a667b572724e887a2c36f34dbc765b"
                            alt="">
                    </div>

                    <div class="flex flex-col items-center mt-8 xl:items-start xl:w-1/2 xl:mt-0">
                        <h2 class="text-xl font-semibold tracking-tight text-gray-800 xl:text-2xl dark:text-white">
                            Bienvenido!
                        </h2>

                        <p class="block max-w-2xl mt-4 text-gray-500 dark:text-gray-300">En esta página podrás consultar el estatus de envió de tu pedido que realizaste en  <b>Jose Luis Mondragon y compañía, SA de
                                CV </b>, si se requiere de información adicional llamar al departamento de ventas.</p>


                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- aqui show -->
    <div class="hidden" id="steps" name="steps">
        <div class="max-w-4xl mx-auto bg-white shadow-lg relative z-20 hidden md:block"
            style="margin-top: -320px; border-radius: 20px;">

            <div class="container px-6 py-6 mx-auto">

                <h1 id="number_p" name="number_p"
                    class="font-bold text-gray-700 text-xl sm:text-xl md:text-2xl leading-tight mb-6">

                </h1>

                <p class="max-w-2xl mx-auto mt-2 text-center text-gray-500 dark:text-gray-300" id="dexcribe"
                    name="dexcribe">

                </p>

            </div>
            <div class="container px-5 py-12 mx-auto flex flex-wrap">

                <div class="flex relative pt-10 pb-20 sm:items-center md:w-2/3 mx-auto" id="recoleccion" name="recoleccion">
                    <div class="h-full w-6 absolute inset-0 flex items-center justify-center">
                        <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>
                    </div>
                    <div
                        class="flex-shrink-0 w-6 h-6 rounded-full mt-10 sm:mt-0 inline-flex items-center justify-center bg-indigo-500 text-white relative z-10 title-font font-medium text-sm">
                        1</div>
                    <div class="flex-grow md:pl-8 pl-6 flex sm:items-center items-start flex-col sm:flex-row">
                        <div
                            class="flex-shrink-0 w-24 h-24 bg-indigo-100 text-indigo-500 rounded-full inline-flex items-center justify-center">

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" viewBox="0 0 512 512">
                                <path fill="currentColor"
                                    d="m256.32 126.24l-120.16 78.25l120.16 78.24L136.16 361L16 282.08l120.16-78.24L16 126.24L136.16 48Zm-120.8 259.52l120.16-78.25l120.16 78.25L255.68 464Zm120.8-103.68l120.16-78.24l-120.16-77.6L375.84 48L496 126.24l-120.16 78.25L496 282.73L375.84 361Z" />
                            </svg>
                        </div>
                        <div class="flex-grow sm:pl-6 mt-6 sm:mt-0">
                            <h2 class="font-medium title-font text-gray-900 mb-1 text-xl">Recolección</h2>
                            <p class="leading-relaxed">El pedido ya se encuentra en proceso de recolección.</p>
                        </div>
                    </div>
                </div>
                <div class="flex relative pb-20 sm:items-center md:w-2/3 mx-auto" id="camino" name="camino">
                    <div class="h-full w-6 absolute inset-0 flex items-center justify-center">
                        <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>
                    </div>
                    <div id="number2" name="number2"
                        class="flex-shrink-0 w-6 h-6 rounded-full mt-10 sm:mt-0 inline-flex items-center justify-center bg-indigo-500 text-white relative z-10 title-font font-medium text-sm">
                        2</div>
                    <div class="flex-grow md:pl-8 pl-6 flex sm:items-center items-start flex-col sm:flex-row">
                        <div id="number2icon" name="number2icon"
                            class="flex-shrink-0 w-24 h-24 bg-indigo-100 text-indigo-500 rounded-full inline-flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-12 h-12">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>

                        </div>
                        <div class="flex-grow sm:pl-6 mt-6 sm:mt-0">
                            <h2 class="font-medium title-font text-gray-900 mb-1 text-xl">En camino</h2>
                            <p class="leading-relaxed">El pedido ya se encuentra en ruta</p>
                        </div>
                    </div>
                </div>
                <div class="flex relative pb-10 sm:items-center md:w-2/3 mx-auto" id="finalizado" name="finalizado">
                    <div class="h-full w-6 absolute inset-0 flex items-center justify-center">
                        <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>
                    </div>
                    <div id="number3" name="number3"
                        class="flex-shrink-0 w-6 h-6 rounded-full mt-10 sm:mt-0 inline-flex items-center justify-center bg-green-500 text-white relative z-10 title-font font-medium text-sm">
                        3</div>
                    <div class="flex-grow md:pl-8 pl-6 flex sm:items-center items-start flex-col sm:flex-row">
                        <div id="number3icon" name="number3icon"
                            class="flex-shrink-0 w-24 h-24 bg-green-100 text-green-500 rounded-full inline-flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-12 h-12">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>

                        </div>
                        <div class="flex-grow sm:pl-6 mt-6 sm:mt-0">
                            <h2 class="font-medium title-font text-gray-900 mb-1 text-xl">Finalizado</h2>
                            <p class="leading-relaxed">El pedido ya fue entragado.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="px-4 md:hidden">
            <div class="-mt-10 max-w-4xl mx-auto bg-white shadow-lg relative z-20" style="border-radius: 20px;">
            <div class="container px-6 py-6 mx-auto">
                <h1 id="number_p1" name="number_p1"
                    class="font-bold text-gray-700 text-xl sm:text-xl md:text-2xl leading-tight mb-6">
                </h1>
                <p class="max-w-2xl mx-auto mt-2 text-center text-gray-500 dark:text-gray-300" id="dexcribe1"
                    name="dexcribe1">
                </p>
            </div>
                <div class="container px-5 py-6 mx-auto flex flex-wrap">
                <div class="flex relative pt-10 pb-20 sm:items-center md:w-2/3 mx-auto" id="recoleccion1" name="recoleccion1">
                    <div class="h-full w-6 absolute inset-0 flex items-center justify-center">
                        <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>
                    </div>
                    <div
                        class="flex-shrink-0 w-6 h-6 rounded-full mt-10 sm:mt-0 inline-flex items-center justify-center bg-indigo-500 text-white relative z-10 title-font font-medium text-sm">
                        1</div>
                    <div class="flex-grow md:pl-8 pl-6 flex sm:items-center items-start flex-col sm:flex-row">
                        <div
                            class="flex-shrink-0 w-24 h-24 bg-indigo-100 text-indigo-500 rounded-full inline-flex items-center justify-center">

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" viewBox="0 0 512 512">
                                <path fill="currentColor"
                                    d="m256.32 126.24l-120.16 78.25l120.16 78.24L136.16 361L16 282.08l120.16-78.24L16 126.24L136.16 48Zm-120.8 259.52l120.16-78.25l120.16 78.25L255.68 464Zm120.8-103.68l120.16-78.24l-120.16-77.6L375.84 48L496 126.24l-120.16 78.25L496 282.73L375.84 361Z" />
                            </svg>
                        </div>
                        <div class="flex-grow sm:pl-6 mt-6 sm:mt-0">
                            <h2 class="font-medium title-font text-gray-900 mb-1 text-xl">Recolección</h2>
                            <p class="leading-relaxed">El pedido ya se encuentra en proceso de recolección.</p>
                        </div>
                    </div>
                </div>
                <div class="flex relative pb-20 sm:items-center md:w-2/3 mx-auto" id="camino" name="camino">
                    <div class="h-full w-6 absolute inset-0 flex items-center justify-center">
                        <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>
                    </div>
                    <div id="number22" name="number22"
                        class="flex-shrink-0 w-6 h-6 rounded-full mt-10 sm:mt-0 inline-flex items-center justify-center bg-indigo-500 text-white relative z-10 title-font font-medium text-sm">
                        2</div>
                    <div class="flex-grow md:pl-8 pl-6 flex sm:items-center items-start flex-col sm:flex-row">
                        <div id="number22icon" name="number22icon"
                            class="flex-shrink-0 w-24 h-24 bg-indigo-100 text-indigo-500 rounded-full inline-flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-12 h-12">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>

                        </div>
                        <div class="flex-grow sm:pl-6 mt-6 sm:mt-0">
                            <h2 class="font-medium title-font text-gray-900 mb-1 text-xl">En camino</h2>
                            <p class="leading-relaxed">El pedido ya se encuentra en ruta</p>
                        </div>
                    </div>
                </div>
                <div class="flex relative pb-10 sm:items-center md:w-2/3 mx-auto" id="finalizado1" name="finalizado1">
                    <div class="h-full w-6 absolute inset-0 flex items-center justify-center">
                        <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>
                    </div>
                    <div id="number33" name="number33"
                        class="flex-shrink-0 w-6 h-6 rounded-full mt-10 sm:mt-0 inline-flex items-center justify-center bg-green-500 text-white relative z-10 title-font font-medium text-sm">
                        3</div>
                    <div class="flex-grow md:pl-8 pl-6 flex sm:items-center items-start flex-col sm:flex-row">
                        <div id="number33icon" name="number33icon"
                            class="flex-shrink-0 w-24 h-24 bg-green-100 text-green-500 rounded-full inline-flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-12 h-12">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>

                        </div>
                        <div class="flex-grow sm:pl-6 mt-6 sm:mt-0">
                            <h2 class="font-medium title-font text-gray-900 mb-1 text-xl">Finalizado</h2>
                            <p class="leading-relaxed">El pedido ya fue entragado. <span style="color:white">El pedido ya fue entragado.....</span> </p>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <p class="text-center p-4 text-gray-600 mt-10">
        Derechos reservados de Jose Luis Mondragon y Ciac
    </p>

</body>
<script src="./controller/rastreo.js"></script>
<script src="views/template/lib/jquery/jquery.js"></script>
<script src="views/template/lib/popper.js/popper.js"></script>
<script src="views/template/lib/bootstrap/bootstrap.js"></script>
<script src="views/template/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
<script src="views/template/lib/moment/moment.js"></script>
<script src="views/template/lib/jquery-ui/jquery-ui.js"></script>

</html>