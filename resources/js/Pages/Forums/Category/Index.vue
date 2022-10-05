<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from '@inertiajs/inertia-vue3';
import Cover from "@/Components/Cover.vue";
import Container from "@/Components/Container.vue";
import Card from "@/Components/Card/Card.vue";
import CardHeader from "@/Components/Card/CardHeader.vue";
import { ChatBubbleLeftEllipsisIcon } from "@heroicons/vue/24/outline"

defineProps({
  category: Object
})
</script>

<template>
  <AuthenticatedLayout>
    <Head :title="$page.props.category.title" />

    <Cover image="https://cdn.noclip.gg/Bxb0m98FxeYTnOpY/Rkbu_Fj_0ubnYp44mEgS4MocO0qR_m4c.jpg" />

    <Container class="relative z-10">
      <div class="w-full max-w-full px-6 py-32 text-center space-y-4">
        <h1 class="text-3xl font-bold text-neutral-50 break-words">
          {{ $page.props.category.title }}
        </h1>

        <p class="text-neutral-200 break-words">
          {{ $page.props.category.description }}
        </p>
      </div>
    </Container>

    <Container>
      <div class="w-full grid grid-cols-6 md:grid-cols-12 gap-8">
        <Card class="col-span-6" :key="board.id" v-for="board in $page.props.category.boards" divide>
          <CardHeader>
            <div class="relative flex flex-col z-10">
              <Link :href="route('forums.board.show', board)" class="text-neutral-50 text-lg font-medium">{{ board.title }}</Link>
              <p class="text-neutral-200 text-sm">{{ board.description }}</p>
            </div>
          </CardHeader>

          <div :key="thread.id" v-for="thread in board.threads" class="relative overflow-hidden grid grid-cols-6 md:grid-cols-12 auto-cols-max">
            <div class="col-span-1 flex items-center justify-center">
              <div class="h-10 w-10 bg-primary-500/10 flex items-center justify-center rounded-full">
                <ChatBubbleLeftEllipsisIcon class="text-primary-500 h-5 w-5" />
              </div>
            </div>

            <div class="col-span-3 md:col-span-8 flex flex-col items-start justify-center p-2">
              <Link :href="route('forums.thread.show', thread)" class="font-medium text-neutral-50">
                {{ thread.title }}
              </Link>
              <p class="text-neutral-200 truncate w-full">
                {{ thread.created_at_for_humans }}
              </p>
            </div>

            <div class="col-span-2 md:ol-span-3 flex items-center justify-start p-2 overflow-hidden">
              <img v-show="thread?.author?.avatar" :src="thread?.author?.avatar" alt="" loading="lazy" class="object-cover select-none pointer-events-none rounded-full absolute -right-6 h-32 w-32 opacity-10">
            </div>
          </div>
        </Card>
      </div>
    </Container>
  </AuthenticatedLayout>
</template>