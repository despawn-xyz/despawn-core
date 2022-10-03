<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Container from "@/Components/Container.vue";
import Card from "@/Components/Card/Card.vue";
import CardHeader from "@/Components/Card/CardHeader.vue";
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

    <Cover image="https://cdn.noclip.gg/Bxb0m98FxeYTnOpY/Rkbu_Fj_0ubnYp44mEgS4MocO0qR_m4c.jpg" />

    <Container class="relative z-10">
      <div class="w-full max-w-full px-6 py-32 text-center space-y-4">
        <img class="object-contain select-none pointer-events-none m-auto w-32 h-32 rounded" src="https://cdn.noclip.gg/ZwrHIowmadgLm2pr/oZq4yj6CzV6h5hl8FdCJpde0-xu-X8Fg.png" alt="kings" loading="lazy">
        <h1 class="text-3xl font-bold text-neutral-50 break-words">
          Welcome to King's Gaming
        </h1>

        <p class="text-neutral-200 break-words">
          A very cool and epic community
        </p>
      </div>
    </Container>

    <Container class="space-y-12">
      <div class="w-full grid grid-cols-12 gap-8">
        <div class="w-full col-span-12 md:col-span-8 space-y-8">
          <Card :key="category.id" v-for="category in $page.props.categories" divide>
            <CardHeader>
              <div class="relative flex flex-col z-10">
                <Link :href="route('forums.category.show', category)" class="text-neutral-50 text-lg font-medium">{{ category.title }}</Link>
                <p class="text-neutral-200 text-sm">{{ category.description }}</p>
              </div>
            </CardHeader>

            <div :key="board.id" v-for="board in category.boards" class="relative overflow-hidden grid grid-cols-6 md:grid-cols-12 auto-cols-max">
              <div class="col-span-1 flex items-center justify-center p-2">
                <div class="h-10 w-10 bg-primary-500/10 flex items-center justify-center rounded-full">
                  <ChatBubbleLeftEllipsisIcon class="text-primary-500 h-5 w-5" />
                </div>
              </div>

              <div class="col-span-3 md:col-span-7 flex flex-col items-start justify-center p-2">
                <Link href="/forums/board/announcements" class="font-medium text-neutral-50">
                  {{ board.title }}
                </Link>
                <p class="text-neutral-200 truncate w-full">
                  {{ board.description }}
                </p>
              </div>

              <div class="hidden md:flex col-span-1 flex-col items-center justify-center p-2 text-center">
                <p class="font-medium text-primary-500">
                  {{ board.threads_count }}
                </p>
                <h6 class="text-neutral-400">
                  Threads
                </h6>
              </div>

              <div class="hidden md:flex col-span-1 flex-col items-center justify-center p-2 text-center">
                <p class="font-medium text-primary-500">
                  {{ board.comments_count }}
                </p>
                <h6 class="text-neutral-400">
                  Replies
                </h6>
              </div>

              <div class="col-span-2 md:ol-span-2 flex items-center justify-start p-2 overflow-hidden">
                <img v-show="board?.latest_thread?.author?.avatar" :src="board?.latest_thread?.author?.avatar" alt="" loading="lazy" class="object-cover select-none pointer-events-none rounded-full absolute -right-6 h-32 w-32 opacity-10">
              </div>
            </div>
          </Card>
        </div>

        <div class="w-full col-span-12 md:col-span-4">
          <Card divide>
            <CardHeader>
              <div class="relative flex flex-col z-10">
                <h4 class="text-neutral-50 text-lg font-medium">Latest Threads</h4>
                <p class="text-neutral-200 text-sm">Latest threads from King's Gaming</p>
              </div>
            </CardHeader>

            <div :key="thread.id" v-for="thread in $page.props.latest_threads" class="relative overflow-hidden grid grid-cols-6 md:grid-cols-12 auto-cols-max">
              <div class="col-span-3 md:col-span-10 flex flex-col items-start justify-center p-2">
                <Link class="text-neutral-100">
                  {{ thread.title }}
                </Link>

                <p class="text-neutral-400 truncate w-full">
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
    </Container>
  </AuthenticatedLayout>
</template>
