<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Popover, PopoverButton, PopoverPanel } from '@headlessui/vue'
import NavLink from '@/Components/NavLink.vue';
import { Link } from '@inertiajs/inertia-vue3';
</script>

<template>
    <div>
        <div>
            <nav>
                <!-- Primary Navigation Menu -->
                <div class="absolute top-0 left-0 z-30 w-full">
                    <div class="mx-auto max-w-[1600px] w-full sm:px-6 lg:px-8">
                      <div class="max-w-full mx-auto px-2 sm:px-6 lg:px-8">
                        <div class="flex items-center justify-between py-4 md:justify-start md:space-x-10">
                          <aside class="flex items-center justify-start lg:w-0 lg:flex-1">
                            <Link class="w-auto" :href="route('home')">
                              <ApplicationLogo class="h-10 w-10" />
                            </Link>
                          </aside>

                          <aside class="hidden sm:block items-center justify-end hidden space-x-4 md:flex md:flex-1 lg:w-0">
                            <Link href="/users" class="text-base font-medium motion-safe:transition text-neutral-100 hover:text-primary-300">
                              Users
                            </Link>

                            <Link href="/store" class="text-base font-medium motion-safe:transition text-neutral-100 hover:text-primary-300">
                              Store
                            </Link>

                            <Popover v-if="$page.props?.auth?.user" v-slot="{ open }" class="relative">
                              <PopoverButton
                                  :class="open ? '' : 'text-opacity-90'"
                                  type="button" class="motion-safe:transition inline-flex items-center text-neutral-100 hover:text-primary-300">
                                <span>{{ $page.props?.auth?.user?.name }}</span>


                                <svg :class="open ? '' : 'text-opacity-70'"
                                     class="ml-2 h-4 w-4 text-neutral-300 transition duration-150 ease-in-out group-hover:text-opacity-80"
                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                     stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                              </PopoverButton>

                              <transition enter-active-class="transition duration-200 ease-out" enter-from-class="translate-y-1 opacity-0"
                                          enter-to-class="translate-y-0 opacity-100" leave-active-class="transition duration-150 ease-in"
                                          leave-from-class="translate-y-0 opacity-100" leave-to-class="translate-y-1 opacity-0">
                                <PopoverPanel class="absolute z-10 mt-3 w-40 sm:px-0">
                                  <div class="overflow-hidden rounded-lg shadow-lg ring-1 ring-black ring-opacity-5">
                                    <div class="relative grid bg-neutral-800 py-2">
                                      <Link :href="route('logout')" method="post" as="button" class="flex flex-col p-2 transition duration-150 ease-in-out hover:bg-neutral-700 focus:outline-none focus-visible:ring focus-visible:ring-primary-500 focus-visible:ring-opacity-50">
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
                                type="button" class="inline-flex items-center justify-center p-2 rounded-md text-neutral-50 bg-neutral-700 hover:text-neutral-200 hover:bg-neutral-800 focus:outline-none focus:text-primary-500 transition duration-150 ease-in-out">
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
                                  <div class="relative grid bg-neutral-800 py-2">
                                    <Link :href="route('home')" class="flex flex-col p-2 transition duration-150 ease-in-out hover:bg-neutral-700 focus:outline-none focus-visible:ring focus-visible:ring-primary-500 focus-visible:ring-opacity-50">
                                      <span class="text-sm font-medium text-neutral-100">
                                        Home
                                      </span>
                                    </Link>
                                    <Link v-show="$page.props?.auth?.user" :href="route('logout')" method="post" as="button" class="flex flex-col p-2 transition duration-150 ease-in-out hover:bg-neutral-700 focus:outline-none focus-visible:ring focus-visible:ring-primary-500 focus-visible:ring-opacity-50">
                                      <span class="text-sm font-medium text-danger-500">
                                        Log out
                                      </span>
                                    </Link>
                                  </div>
                                </div>
                              </PopoverPanel>
                            </transition>
                          </Popover>
                        </div>
                      </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>
