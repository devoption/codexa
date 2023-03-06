<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=jetbrains-mono:100,200,300,400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite('resources/css/app.css')

        <style>
            :root {
                --color-primary: {{ config('docs.colors.primary') }};
                --color-secondary: {{ config('docs.colors.secondary') }};
            }
        </style>
        @vite('resources/js/app.js')
    </head>
    <body x-init="" x-cloak x-data="theme" class="antialiased bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-gray-200 font-jetbrains">
        <div class="flex">
            <aside class="hidden fixed top-0 bottom-0 left-0 z-20 h-full w-16 bg-gradient-to-b from-gray-200 to-gray-100 transition-all duration-300 overflow-hidden lg:sticky lg:w-80 lg:shrink-0 lg:flex lg:flex-col lg:justify-end lg:items-end 2xl:max-w-lg 2xl:w-full dark:from-gray-900 dark:to-gray-800">
                <div class="relative min-h-0 flex-1 flex flex-col xl:w-80">
                    <a href="/" class="flex items-center py-8 px-4 lg:px-8 xl:px-16">
                        <h1 class="flex flex-col">
                            <div class=" text-xl text-primary font-bold">
                                { <span class="text-gray-500 dark:text-gray-200">dev</span>option }
                            </div>
                            <span class="text-sm text-gray-400 text-center">codexa</span>
                        </h1>
                    </a>
                    <div class="overflow-y-auto overflow-x-hidden px-4 lg:overflow-hidden lg:px-8 xl:px-16">
                        <nav id="indexed-nav" class="hidden lg:block lg:mt-4">
                            <div id="docs_sidebar">
                                @foreach ($links as $link)
                                    {{-- if the link is not a sub or parent, then show the link --}}
                                    @if ($link['sub'] == false && $link['parent'] == false)
                                        <a href="{{ $link['url'] }}" class="block {{ $link['active'] ? 'active' : ' ' }}">
                                            {{ $link['name'] }}
                                        </a>
                                    @endif

                                    {{-- if the link is a parent, then show the parent --}}
                                    @if ($link['parent'] === 'self')
                                        <a @click="toggle('{{ Str::lower($link['name']) }}-sub')" class="block {{ $link['active'] ? 'active' : ' ' }} parent">
                                            {{ $link['name'] }}
                                        </a>
                                    @endif

                                    {{-- if the link is a sub, then show the sub --}}
                                    @if ($link['sub'] === true)
                                        <a href="{{ $link['url'] }}" class="{{ Str::lower($link['parent']) }}-sub {{ in_array($link['parent'], $parent_active) ? '' : 'hidden' }} block ml-4 {{ $link['active'] ? 'active' : ' ' }}">
                                            {{ $link['name'] }}
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </nav>
                    </div>
                </div>
            </aside>
            <section class="flex-1 dark:bg-gray-800">
                <div class="max-w-screen-lg px-8 sm:px-16 lg:px-24">
                    <div class="flex flex-col items-end border-b border-gray-200 py-1 transition-colors dark:border-gray-700 lg:mt-8 lg:flex-row-reverse">
                        <div class="hidden lg:flex items-center justify-center ml-8">
                            <button x-show="isLight" id="header__sun" @click="systemMode(); console.log(theme)" title="Switch to system theme" class="relative w-10 h-10 focus:outline-none focus:shadow-outline text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-sun" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <circle cx="12" cy="12" r="4"></circle>
                                    <path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7"></path>
                                 </svg>
                            </button>
                            <button x-show="isDark"  @click="lightMode(); console.log(theme)" id="header__moon" title="Switch to light mode" class="relative w-10 h-10 focus:outline-none focus:shadow-outline text-gray-500">
                                <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M17.75,4.09L15.22,6.03L16.13,9.09L13.5,7.28L10.87,9.09L11.78,6.03L9.25,4.09L12.44,4L13.5,1L14.56,4L17.75,4.09M21.25,11L19.61,12.25L20.2,14.23L18.5,13.06L16.8,14.23L17.39,12.25L15.75,11L17.81,10.95L18.5,9L19.19,10.95L21.25,11M18.97,15.95C19.8,15.87 20.69,17.05 20.16,17.8C19.84,18.25 19.5,18.67 19.08,19.07C15.17,23 8.84,23 4.94,19.07C1.03,15.17 1.03,8.83 4.94,4.93C5.34,4.53 5.76,4.17 6.21,3.85C6.96,3.32 8.14,4.21 8.06,5.04C7.79,7.9 8.75,10.87 10.95,13.06C13.14,15.26 16.1,16.22 18.97,15.95M17.33,17.97C14.5,17.81 11.7,16.64 9.53,14.5C7.36,12.31 6.2,9.5 6.04,6.68C3.23,9.82 3.34,14.64 6.35,17.66C9.37,20.67 14.19,20.78 17.33,17.97Z"></path>
                                </svg>
                            </button>
                            <button x-show="isSystem" id="header__indeterminate" @click="darkMode(); console.log(theme)" title="Switch to dark mode" class="relative w-10 h-10 focus:outline-none focus:shadow-outline text-gray-500">
                                <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M12 2A10 10 0 0 0 2 12A10 10 0 0 0 12 22A10 10 0 0 0 22 12A10 10 0 0 0 12 2M12 4A8 8 0 0 1 20 12A8 8 0 0 1 12 20V4Z"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="relative mt-8 flex items-center justify-end w-full h-10 lg:mt-0">
                            <div class="flex-1 flex items-center">
                                <button class="relative inline-flex items-center text-gray-800 transition-colors dark:text-gray-400 w-full" @click.prevent="$dispatch('toggle-search-modal')">
                                    <svg class="w-5 h-5 text-gray-700 pointer-events-none transition-colors dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                    <span class="ml-3">Search</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <section class="mt-8 md:mt-16">
                        <section class="docs_main max-w-prose">
                            <div id="main-content">
                                {!! Str::markdown($content) !!}
                            </div>
                        </section>
                    </section>
                </div>
            </section>
        </div>
    </body>
</html>
