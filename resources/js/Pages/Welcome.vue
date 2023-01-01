<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Card from "@/Components/Card/Card.vue";
import { ChatBubbleLeftEllipsisIcon } from "@heroicons/vue/24/outline"
import Cover from "@/Components/Cover.vue";
import CardHeader from "@/Components/Card/CardHeader.vue";
import CardTitle from "@/Components/Card/CardTitle.vue";

defineProps({
  categories: Object,
  latest_threads: Object
})
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Welcome" />

    <template #cover>
      <Cover image="https://cdn.noclip.gg/Bxb0m98FxeYTnOpY/Rkbu_Fj_0ubnYp44mEgS4MocO0qR_m4c.jpg" />
    </template>

    <div class="relative space-y-12">
      <div class="w-full grid grid-cols-12 gap-4">
        <div class="w-full col-span-12 md:col-span-8 space-y-4">
          <div :key="category.id" v-for="category in $page.props.categories">
            <template v-if="category.can.view_category">
              <Card divide>
                <CardHeader>
                  <CardTitle>
                    <Link :href="route('forums.category.show', category)">{{ category.title }}</Link>
                  </CardTitle>
                </CardHeader>

                <template :key="board.id" v-for="board in category.boards">
                  <template v-if="board.can.view_board">
                    <div class="relative bg-white/2.5 overflow-hidden grid grid-cols-6 md:grid-cols-12 auto-cols-max">
                      <div class="col-span-1 flex items-center justify-center p-2">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full ring-1 backdrop-blur-[2px] transition duration-300 bg-primary-500/10 ring-primary-500">
                          <ChatBubbleLeftEllipsisIcon class="h-6 w-6 transition-colors duration-300 fill-primary-500/10 stroke-primary-500" />
                        </div>
                      </div>

                      <div class="col-span-3 md:col-span-6 flex flex-col items-start justify-center p-2">
                        <Link :href="route('forums.board.show', board)" class="font-medium text-white">
                          {{ board.title }}
                        </Link>
                        <p class="text-gray-400 text-xs truncate w-full">
                          {{ board.description }}
                        </p>
                      </div>

                      <div class="hidden md:flex col-span-1 flex-col items-end justify-center p-2 text-right">
                        <p class="font-medium text-primary-500">
                          {{ board.threads_count }}
                        </p>
                        <h6 class="text-gray-400 text-xs">
                          Threads
                        </h6>
                      </div>

                      <div class="relative col-span-3 md:col-span-4 flex flex-col items-start justify-center p-2 text-left overflow-hidden">
                        <template v-if="board?.latest_thread">
                          <Link :href="route('forums.thread.show', board?.latest_thread)" class="block font-medium text-white truncate">
                            {{ board?.latest_thread?.title }}
                          </Link>
                          <span class="w-full truncate text-gray-400">
                            <Link class="text-gray-50">
                              {{ board?.latest_thread?.author?.name }}
                            </Link>
                            , {{ board?.latest_thread?.created_at_for_humans }}
                          </span>

                          <img :src="board?.latest_thread?.author?.avatar" alt="" loading="lazy" class="object-cover select-none pointer-events-none rounded-full absolute -bottom-10 -right-6 h-32 w-32 opacity-10">
                        </template>
                      </div>
                    </div>
                  </template>
                </template>
              </Card>
            </template>
          </div>
        </div>

        <div class="w-full col-span-12 md:col-span-4">
          <Card divide>
            <CardHeader>
              <CardTitle>
                Latest Threads
              </CardTitle>
            </CardHeader>

            <div :key="thread.id" v-for="thread in $page.props.latest_threads" class="relative bg-white/2.5 overflow-hidden grid grid-cols-6 md:grid-cols-12 auto-cols-max">
              <div class="col-span-3 md:col-span-10 flex flex-col items-start justify-center p-2">
                <Link :href="route('forums.thread.show', thread)" class="text-white">
                  {{ thread.title }}
                </Link>

                <p class="text-gray-400 truncate w-full text-xs">
                  {{ thread.created_at_for_humans }} {{ thread.was_recently_updated ? ' - updated' : null}}
                </p>
              </div>

              <div class="col-span-3 md:col-span-2 flex items-center justify-start p-2">
                <img :src="thread.author.avatar" :alt="thread.author.name" loading="lazy" class="object-cover select-none pointer-events-none rounded-full absolute -right-6 opacity-25 h-28 w-28">
              </div>
            </div>
          </Card>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
