<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Card from "@/Components/Card/Card.vue";
import { ChatBubbleLeftEllipsisIcon } from "@heroicons/vue/24/outline"
import Cover from "@/Components/Cover.vue";

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
            <div class="relative flex flex-col p-2">
              <Link :href="route('forums.category.show', category)" class="text-gray-50 text-lg font-medium">{{ category.title }}</Link>
            </div>

            <Card class="bg-gray-800 shadow-slim" divide>
              <div :key="board.id" v-for="board in category.boards" class="relative overflow-hidden grid grid-cols-6 md:grid-cols-12 auto-cols-max">
                <div class="col-span-1 flex items-center justify-center p-2">
                  <div class="h-10 w-10 bg-primary-500/10 flex items-center justify-center rounded-full">
                    <ChatBubbleLeftEllipsisIcon class="text-primary-500 h-5 w-5" />
                  </div>
                </div>

                <div class="col-span-3 md:col-span-6 flex flex-col items-start justify-center p-2">
                  <Link :href="route('forums.board.show', board)" class="font-medium text-white">
                    {{ board.title }}
                  </Link>
                  <p class="text-gray-300 truncate w-full">
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
            </Card>
          </div>
        </div>

        <div class="w-full col-span-12 md:col-span-4">
          <div class="relative flex flex-col p-2">
            <h4 class="text-gray-100 text-lg font-medium">Latest Threads</h4>
          </div>

          <Card class="bg-gray-800 shadow-slim" divide>
            <div :key="thread.id" v-for="thread in $page.props.latest_threads" class="relative overflow-hidden grid grid-cols-6 md:grid-cols-12 auto-cols-max">
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
