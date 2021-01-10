<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <title>TinyUrl</title>
    </head>
    <body class="bg-gray-200">
        <div class="container mx-auto py-6 px-4">
            <h1 class="text-3xl py-4 border-b mb-10">TinyUrl- A URL Shortner Service</h1>
            <div class="flex justify-center">
                <div class="w-full bg-white p-6 rounded-lg">
                    <form method="POST" action="{{ route('home') }}">
                        @csrf
                        <div class="mb-4">
                            <textarea type="text" name="link" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('link') border-red-500 @enderror"  placeholder="Enter a URL"> {{ old('link') }}</textarea>
                            @error('link')
                                <div class="text-xs font-semibold text-red-600 italic">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb4">
                            <button class="bg-blue-500 text-white px-4 py-2 rounded font-medium" type="submit">Shorten the Link</button>
                        </div>
                    </form>
                    @if(Session::has('success_msg'))
                        <div class=" mt-2 text-sm">
                            <p class="text-green-500" >{{ Session::get('success_msg') }}</p>
                            <p><strong>TinyUrl:</strong> <a class ="hover:bg-blue-50" href="{{ Session::get('shortenedUrl') }}" target="_blank">{{ Session::get('shortenedUrl') }}</a></p>
                            <p><strong>ActualUrl:</strong> {{ Session::get('originalUrl') }}</p>
                        </div>
                    @endif
                    @if(Session::has('error_msg'))
                        <div class=" mt-2 text-sm">
                            <p class="text-red-500">{{ Session::get('error_msg') }}</p>
                            <p ><strong>TinyUrl:</strong> <a class ="hover:bg-blue-50" href="{{ Session::get('shortenedUrl') }}" target="_blank">{{ Session::get('shortenedUrl') }}</a></p>
                            <p ><strong>ActualUrl:</strong> {{ Session::get('originalUrl') }}</p>
                        </div>
                    @endif
                    @if(Session::has('redirect_error_msg'))
                        <div class="text-red-500 mt-2 text-sm">
                            {{ Session::get('redirect_error_msg') }}
                        </div>
                    @endif
                </div>
            </div>

            @if ($ShortenLinks->count())
                <div class="overflow-x-auto rounded-lg" style="margin: 10px;">
                    <table class="table-fixed shadow-lg ">
                        <thead>
                            <tr>
                                <th class="bg-blue-100 border text-left px-8 py-4">TinyUrl</th>
                                <th class="bg-blue-100 border text-left px-8 py-4">Actual URL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ShortenLinks as $row)
                                <tr>
                                    <td class="border px-8 py-4 bg-white"><a class =" hover:bg-blue-50" href="{{ route('redirectURL', $row->slug) }}" target="_blank">{{ route('redirectURL', $row->slug) }}</a></td>
                                    <td class="border px-8 py-4 bg-white">{{ $row->link }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class= "text-red-500 mt-2 text-sm"> There are no URLs in the database use the above input box to add one and shorten  </p>
            @endif

        </div>

    </body>
</html>
