<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Cover from "@/Components/Cover.vue";
import Card from "@/Components/Card/Card.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import Editor from "@/Components/Editor.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Post from "@/Components/Thread/Post.vue";
import { ChatBubbleLeftEllipsisIcon, ChevronLeftIcon } from "@heroicons/vue/20/solid";
import Comment from "@/Components/Thread/Comment.vue";

const props = defineProps({
  thread: Object,
  board: Object,
  category: Object
})

const form = useForm({
  body: ''
});

const submit = () => {
  form.post(route('forums.thread.comment.store', props.thread))
}
</script>

<template>
  <AuthenticatedLayout>
    <Head :title="$page.props.thread.title" />

    <template #cover>
      <Cover image="https://cdn.noclip.gg/Bxb0m98FxeYTnOpY/Rkbu_Fj_0ubnYp44mEgS4MocO0qR_m4c.jpg" />
    </template>

    <div class="space-y-4">
      <div class="w-full flex items-center justify-between">
        <Link :href="route('forums.board.show', board)" class="flex items-center justify-center bg-gray-600 border border-gray-200/20 rounded shadow-slim p-2 font-medium text-gray-50 hover:text-white">
          <ChevronLeftIcon class="w-4 h-4 mr-1" />
          Back to {{ $page.props.board.title }}
        </Link>

        <Link class="flex items-center justify-center bg-gray-600 border border-gray-200/20 rounded shadow-slim p-2 font-medium text-gray-50 hover:text-white">
          <ChatBubbleLeftEllipsisIcon class="w-4 h-4 mr-2" />
          Comment
        </Link>
      </div>
      <Card class="w-full h-full grid grid-cols-1 md:grid-cols-[200px,minmax(900px,1fr)] shadow-slim bg-gray-800">
        <aside class="relative isolate overflow-hidden w-full h-full md:min-h-[22rem] p-4 md:border-r border-gray-200/5 motion-safe:transition rounded-tl-lg">
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

        <Post :thread="$page.props.thread" />
      </Card>
    </div>

    <hr class="my-8 border-gray-200/20">

    <div class="space-y-4">
      <Card v-for="comment in $page.props.thread.comments" class="w-full h-full grid grid-cols-1 md:grid-cols-[200px,minmax(900px,1fr)] shadow-slim bg-gray-700">
        <aside class="relative isolate overflow-hidden w-full h-full md:min-h-[22rem] p-4 md:border-r border-gray-200/5 motion-safe:transition rounded-tl-lg">
          <div class="relative flex flex-col items-center break-words">
            <div>
              <Link class="flex items-center text-white font-medium text-lg">
                {{ comment.commenter.name }}
              </Link>
            </div>

            <img :src="comment.commenter.avatar" :alt="comment.commenter.name" class="object-cover select-none pointer-events-none rounded-full w-full h-full max-w-[7rem] max-h-[7rem] mt-2">

            <p class="text-center text-primary-500 font-medium rounded-lg bg-primary-500/10 border border-primary-500/20 py-2 w-full mt-4">
              User
            </p>
          </div>
        </aside>

        <Comment :thread="$page.props.thread" :comment="comment" />
      </Card>

      <Card class="bg-gray-700 shadow-slim p-2">
        <form @submit.prevent="submit">
          <div class="space-y-2">
            <InputLabel value="Comment" />
            <Editor v-model="form.body" />
            <InputError :message="form.errors.body" />
          </div>

          <PrimaryButton class="mt-4">
            Create Comment
          </PrimaryButton>
        </form>
      </Card>
    </div>
  </AuthenticatedLayout>
</template>