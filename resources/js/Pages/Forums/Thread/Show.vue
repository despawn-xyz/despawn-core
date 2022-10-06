<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Cover from "@/Components/Cover.vue";
import Card from "@/Components/Card/Card.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { ClockIcon, ChatBubbleLeftEllipsisIcon, ChevronLeftIcon, PencilIcon } from "@heroicons/vue/20/solid";
import StaticEditor from "@/Components/StaticEditor.vue";

defineProps({
  thread: Object,
  board: Object,
  category: Object
})
</script>

<template>
  <AuthenticatedLayout>
    <Head :title="$page.props.thread.title" />

    <template #cover>
      <Cover image="https://cdn.noclip.gg/Bxb0m98FxeYTnOpY/Rkbu_Fj_0ubnYp44mEgS4MocO0qR_m4c.jpg" />
    </template>

    <div class="space-y-4">
      <div class="w-full flex items-center justify-between">
        <Link class="flex items-center justify-center bg-neutral-600 border border-neutral-200/20 rounded shadow-slim p-2 font-medium text-neutral-50 hover:text-white" :href="route('forums.category.show', category)">
          <ChevronLeftIcon class="w-4 h-4 mr-1" />
          Back to {{ $page.props.board.title }}
        </Link>

        <Link class="flex items-center justify-center bg-neutral-600 border border-neutral-200/20 rounded shadow-slim p-2 font-medium text-neutral-50 hover:text-white">
          <ChatBubbleLeftEllipsisIcon class="w-4 h-4 mr-2" />
          Comment
        </Link>
      </div>
      <Card class="w-full h-full grid grid-cols-1 md:grid-cols-[200px,minmax(900px,1fr)] shadow-slim bg-neutral-700">
        <aside class="relative isolate overflow-hidden w-full h-full md:min-h-[22rem] p-4 md:border-r border-neutral-200/5 motion-safe:transition rounded-tl-lg">
          <div class="relative flex flex-col items-center break-words">
            <div>
              <Link class="flex items-center text-white font-medium text-lg">
                {{ $page.props.thread.author.name }}
              </Link>
            </div>

            <img :src="$page.props.thread.author.avatar" :alt="$page" class="object-cover select-none pointer-events-none rounded-full w-full h-full max-w-[7rem] max-h-[7rem] mt-2">

            <p class="text-center text-primary-500 font-medium rounded-lg bg-primary-500/10 border border-primary-500/20 py-2 w-full mt-4">
              User
            </p>
          </div>
        </aside>

        <article class="flex flex-col">
          <header class="flex items-center text-neutral-400 py-2 p-4">
            <ClockIcon class="w-4 h-4" />

            <p class="ml-1">
              {{ $page.props.thread.created_at_for_humans }}

              <template v-if="$page.props.thread.was_recently_edited">
                - edited
              </template>
            </p>

            <Link class="ml-auto text-neutral-50 hover:text-white" :href="`#${$page.props.thread.id}`">
              #{{ $page.props.thread.id }}
            </Link>
          </header>

          <div class="prose prose-neutral dark:prose-invert break-words whitespace-normal max-w-none flex-grow p-4">
            <h1 class="block text-2xl font-bold text-neutral-50 break-words">
              {{ $page.props.thread.title }}
            </h1>

            <StaticEditor :content="$page.props.thread.body" />
          </div>

          <footer class="p-4 flex col-span-full border-t border-neutral-200/5">
            <div class="ml-auto flex items-center space-x-2">
              <Link class="flex items-center justify-center bg-neutral-600 border border-neutral-200/20 rounded shadow-slim p-2 font-medium text-neutral-50 hover:text-white">
                <PencilIcon class="w-4 h-4 mr-2" />
                Edit
              </Link>
            </div>
          </footer>
        </article>
      </Card>
    </div>
  </AuthenticatedLayout>
</template>