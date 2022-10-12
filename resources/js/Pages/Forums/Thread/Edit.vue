<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import Editor from "@/Components/Editor.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Card from "@/Components/Card/Card.vue";

const props = defineProps({
  thread: Object
})

const form = useForm({
  title: props.thread.title,
  body: props.thread.body
})

const submit = () => {
  form.put(route('forums.thread.update', props.thread));
};
</script>

<template>
  <AuthenticatedLayout>
    <div class="space-y-4">
      <div>
        <h1 class="font-bold text-2xl text-white">
           Edit Thread: {{ $page.props.thread.title }}
        </h1>
        <p class="text-gray-400">
          Updating a thread will show that it's been edited.
        </p>
      </div>

      <Card class="bg-gray-700 shadow-slim p-4">
        <form @submit.prevent="submit" class="space-y-4">
          <div class="space-y-2">
            <InputLabel value="title" />
            <TextInput v-model="form.title" type="text" />
            <InputError :message="form.errors.title" />
          </div>

          <div class="space-y-2">
            <InputLabel value="body" />
            <Editor v-model="form.body" />
            <InputError :message="form.errors.body" />
          </div>

          <PrimaryButton class="mt-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
            Update thread
          </PrimaryButton>
        </form>
      </Card>

    </div>
  </AuthenticatedLayout>
</template>