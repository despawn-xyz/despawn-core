<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from '@inertiajs/inertia-vue3';
import Cover from "@/Components/Cover.vue";
import Card from "@/Components/Card/Card.vue";
import { ChatBubbleLeftEllipsisIcon } from "@heroicons/vue/24/outline"

defineProps({
  category: Object
})
</script>

<template>
  <AuthenticatedLayout>
    <Head :title="$page.props.category.title" />

    <template #cover>
      <Cover image="https://cdn.noclip.gg/Bxb0m98FxeYTnOpY/Rkbu_Fj_0ubnYp44mEgS4MocO0qR_m4c.jpg" />
    </template>

    <Card class="w-full text-left flex items-center justify-between p-4">
      <div>
        <h1 class="block text-xl font-bold text-gray-50 break-words">
          {{ $page.props.category.title }}
        </h1>

        <p class="block text-gray-400 break-words">
          {{ $page.props.category.description }}
        </p>
      </div>
    </Card>

    <div class="w-full grid gap-y-4 pt-4">
      <div :key="board.id" v-for="board in $page.props.category.boards">
        <div class="relative flex flex-col z-10 py-2">
          <Link :href="route('forums.board.show', board)" class="text-gray-50 text-lg font-medium">{{ board.title }}</Link>
          <p class="text-gray-200 text-sm">{{ board.description }}</p>
        </div>

        <Card v-if="board.threads.length > 0" class="bg-gray-800" divide>
          <div :key="thread.id" v-for="thread in board.threads" class="relative overflow-hidden grid grid-cols-6 md:grid-cols-12 auto-cols-max">
            <div class="col-span-1 flex items-center justify-center">
              <div class="h-10 w-10 bg-primary-500/10 flex items-center justify-center rounded-full">
                <ChatBubbleLeftEllipsisIcon class="text-primary-500 h-5 w-5" />
              </div>
            </div>

            <div class="col-span-3 md:col-span-8 flex flex-col items-start justify-center p-2">
              <Link :href="route('forums.thread.show', thread)" class="font-medium text-gray-50">
                {{ thread.title }}
              </Link>
              <p class="text-gray-200 truncate w-full">
                {{ thread.created_at_for_humans }}
              </p>
            </div>

            <div class="col-span-2 md:ol-span-3 flex items-center justify-start p-2 overflow-hidden">
              <img v-show="thread?.author?.avatar" :src="thread?.author?.avatar" alt="" loading="lazy" class="object-cover select-none pointer-events-none rounded-full absolute -right-6 h-32 w-32 opacity-10">
            </div>
          </div>
        </Card>
        <Card v-else class="bg-gray-800">
          <div class="w-full p-2 flex items-center justify-center">
            <p class="text-gray-400">
              There are no threads in this board, <Link class="text-primary-500">create one?</Link>
            </p>
          </div>
        </Card>
      </div>
    </div>
  </AuthenticatedLayout>
</template>