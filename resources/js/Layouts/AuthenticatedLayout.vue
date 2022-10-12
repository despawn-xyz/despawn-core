<script setup>
import { Popover, PopoverButton, PopoverPanel } from '@headlessui/vue'
import NavLink from '@/Components/NavLink.vue';
import { Link } from '@inertiajs/inertia-vue3';
import Card from "@/Components/Card/Card.vue";
import Container from "@/Components/Container.vue";
import { Modal } from "momentum-modal"
</script>

<template>
  <div :key="$page.url" class="min-h-screen mx-auto text-base">
    <!-- Primary Navigation Menu -->
    <nav class="absolute top-0 left-0 z-30 w-full">
      <Container>
        <div class="flex items-center justify-between py-4 md:justify-start md:space-x-10 text-md">
          <aside class="hidden sm:block items-center justify-start md:flex md:flex-1 lg:w-0 divide-x divide-gray-200/5">
            <NavLink :href="route('home')">
              home
            </NavLink>

            <NavLink href="/users">
              Users
            </NavLink>

            <NavLink href="/store">
              Store
            </NavLink>
          </aside>

          <aside class="hidden sm:block items-center justify-end hidden space-x-4 md:flex md:flex-1 lg:w-0">
            <Popover v-if="$page.props?.auth?.user" v-slot="{ open }" class="relative">
              <PopoverButton
                  :class="open ? '' : 'text-opacity-90'"
                  type="button" class="motion-safe:transition inline-flex items-center text-gray-100 hover:text-primary-300">
                <img :src="$page.props?.auth.user?.avatar" class="h-8 w-8 rounded-full object-cover object-center" alt="avatar">

                <svg :class="open ? '' : 'text-opacity-70'"
                     class="ml-2 h-4 w-4 text-gray-300 transition duration-150 ease-in-out group-hover:text-opacity-80"
                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
              </PopoverButton>

              <transition enter-active-class="transition duration-200 ease-out" enter-from-class="translate-y-1 opacity-0"
                          enter-to-class="translate-y-0 opacity-100" leave-active-class="transition duration-150 ease-in"
                          leave-from-class="translate-y-0 opacity-100" leave-to-class="translate-y-1 opacity-0">
                <PopoverPanel class="absolute right-0.5 z-10 mt-3 w-40 sm:px-0">
                  <div class="overflow-hidden rounded-lg shadow-lg ring-1 ring-black ring-opacity-5">
                    <div class="relative grid bg-gray-800 py-2">
                      <Link :href="route('profile.show')" class="flex flex-col p-2 transition duration-150 ease-in-out hover:bg-gray-700 focus:outline-none focus-visible:ring focus-visible:ring-primary-500 focus-visible:ring-opacity-50">
                        <span class="text-sm font-medium text-gray-100">
                          Profile
                        </span>
                      </Link>
                      <Link :href="route('logout')" method="post" as="button" class="flex flex-col p-2 transition duration-150 ease-in-out hover:bg-gray-700 focus:outline-none focus-visible:ring focus-visible:ring-primary-500 focus-visible:ring-opacity-50">
                        <span class="text-sm font-medium text-danger-500">
                          Log out
                        </span>
                      </Link>
                    </div>
                  </div>
                </PopoverPanel>
              </transition>
            </Popover>

            <template v-else>
              <NavLink :href="route('login')">
                Login
              </NavLink>

              <NavLink :href="route('register')">
                Register
              </NavLink>
            </template>
          </aside>

          <!-- Hamburger -->
          <Popover v-slot="{ open }" class="relative block sm:hidden">
            <PopoverButton
                :class="open ? '' : 'text-opacity-90'"
                type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-50 bg-gray-700 hover:text-gray-200 hover:bg-gray-800 focus:outline-none focus:text-primary-500 transition duration-150 ease-in-out">
              <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path class="inline-flex ui-active:hidden w-8 h-8 fill-current" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                <path class="hidden ui-active:inline-flex w-8 h-8 fill-current" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </PopoverButton>


            <transition enter-active-class="transition duration-200 ease-out" enter-from-class="translate-y-1 opacity-0"
                        enter-to-class="translate-y-0 opacity-100" leave-active-class="transition duration-150 ease-in"
                        leave-from-class="translate-y-0 opacity-100" leave-to-class="translate-y-1 opacity-0">
              <PopoverPanel class="absolute right-1/2 z-10 mt-3 w-40 px-2 sm:px-0">
                <div class="overflow-hidden rounded-lg shadow-lg ring-1 ring-black ring-opacity-5">
                  <div class="relative grid bg-gray-800 py-2">
                    <Link :href="route('home')" class="flex flex-col p-2 transition duration-150 ease-in-out hover:bg-gray-700 focus:outline-none focus-visible:ring focus-visible:ring-primary-500 focus-visible:ring-opacity-50">
                      <div class="text-sm font-medium text-gray-100">
                        Home
                      </div>
                    </Link>
                    <Link v-show="$page.props?.auth?.user" :href="route('logout')" method="post" as="button" class="flex flex-col p-2 transition duration-150 ease-in-out hover:bg-gray-700 focus:outline-none focus-visible:ring focus-visible:ring-primary-500 focus-visible:ring-opacity-50">
                      <div class="text-sm font-medium text-danger-500">
                        Log out
                      </div>
                    </Link>
                  </div>
                </div>
              </PopoverPanel>
            </transition>
          </Popover>
        </div>
      </Container>
    </nav>

    <div class="relative bg-primary-600 py-24 z-0 overflow-hidden">
      <slot name="cover" />
      <Container class="relative z-10 flex flex-col items-center justify-center">
        <img src="https://cdn.noclip.gg/ZwrHIowmadgLm2pr/oZq4yj6CzV6h5hl8FdCJpde0-xu-X8Fg.png" alt="kings" class="object-contain select-none pointer-events-none m-auto w-24 h-24 rounded" loading="lazy">

        <h1 class="block text-3xl font-bold text-white break-words mt-4">
          King's Gaming
        </h1>
      </Container>
    </div>

    <!-- Page Content -->
    <main class="relative z-10">
      <Container class="py-12">
        <slot />
      </Container>
    </main>

    <Modal />
  </div>
</template>