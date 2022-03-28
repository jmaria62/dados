<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://cdn.tailwindcss.com"></script>

        <title>Laravel</title>

        
    </head>
    <body class="bg-gray-100 text-gray-700 ">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-3 my-10">
            
                @foreach ($rolls as $roll)
                    <div class="bg-white hover:bg-blue-100 border border-gray-200 p-5" >
                        
                         
                        
                         <p class="text-xm">
                            Dado1: {{$roll->value1}}
                        </p>
                        <p class="text-xm">
                             Dado2: {{$roll->value2}} 
                        </p>       
        
                        <p class="text-xm">
                             Usuario: {{$roll->user_id}}
                        </p>    
                        
                    </div>
        
        
                @endforeach
                <div class="mb-10">
                 {{$rolls->links()}}
                </div>
            
            </div>
        </div>
        
    </body>
</html>
