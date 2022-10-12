<script setup>

import { useForm } from "@inertiajs/inertia-vue3";
import {ref} from "vue";
import Card from "@/Components/Card/Card.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
  user: {
    type: Object
  }
})

const form = useForm({
  _method: 'PUT',
  name: props.user.name,
  email: props.user.email,
})

const updateProfileInformation = () => {
  form.post(route('profile.update-profile-information'), {
    errorBag: 'updateProfileInformation',
    preserveScroll: true
  })
}
</script>

<template>
  <form class="block w-full" @submit.prevent="updateProfileInformation">
    <Card class="bg-gray-700 flex flex-col">
      <div class="flex items-center p-4">
        <div class="flex flex-col space-y-4 w-full">
          <div class="space-y-2">
            <InputLabel for="name" value="Name" />
            <TextInput id="name" v-model="form.name" type="text" class="w-full max-w-lg" />
            <InputError :message="form.errors.name" />
          </div>

          <div class="space-y-2">
            <InputLabel for="email" value="Email"/>
            <TextInput v-model="form.email" type="email" class="w-full max-w-lg" />
            <InputError :message="form.errors.email" />
          </div>
        </div>
      </div>

      <div class="w-full p-4 flex items-center justify-end">
        <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
          Save
        </PrimaryButton>
      </div>
    </Card>
  </form>
</template>