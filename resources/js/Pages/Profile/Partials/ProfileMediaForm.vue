<script setup>

import { useForm } from "@inertiajs/inertia-vue3";
import {ref} from "vue";
import { Inertia } from '@inertiajs/inertia';
import Card from "@/Components/Card/Card.vue";
import InputLabel from "@/Components/InputLabel.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
  user: {
    type: Object
  }
})

const form = useForm({
  _method: 'PUT',
  avatar: null
})

const avatarPreview = ref(null)
const avatarInput = ref(null)

const updateProfileMedia = () => {
  if (avatarInput.value) {
    form.avatar = avatarInput.value.files[0]
  }

  form.post(route('profile.update-media'), {
    errorBag: 'updateProfileInformation',
    preserveScroll: true,
    onSuccess: () => clearAvatarInput(),
  })
}

const selectNewAvatar = () => {
  avatarInput.value.click();
}

const updateAvatarPreview = () => {
  const avatar = avatarInput.value.files[0]

  if (! avatar) return;

  const reader = new FileReader();

  reader.onload = (e) => {
    avatarPreview.value = e.target.result;
  }

  reader.readAsDataURL(avatar)

  updateProfileMedia()
}

const deleteAvatar = () => {
  Inertia.delete(route('profile.avatar.destroy'), {
    preserveScroll: true,
    onSuccess: () => {
      avatarPreview.value = null;
      clearAvatarInput();
    }
  })
}

const clearAvatarInput = () => {
  if (avatarInput.value?.value) {
    avatarInput.value.value = null;
  }
}
</script>
<template>

  <form class="block w-full" @submit.prevent="updateProfileMedia">
    <Card class="bg-gray-700">
      <div class="flex items-center p-4 space-x-4">
        <div>
          <input
              ref="avatarInput"
              type="file"
              class="hidden"
              @change="updateAvatarPreview"
          >
          <div v-show="! avatarPreview">
            <img :src="user.avatar" :alt="user.name" class="rounded-full h-20 w-20 object-cover">
          </div>

          <!-- New Profile Photo Preview -->
          <div v-show="avatarPreview">
            <div
                class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                :style="'background-image: url(\'' + avatarPreview + '\');'"></div>
          </div>
        </div>
        <div>
          <InputLabel value="Avatar" />
          <p class="text-xs text-gray-400 mt-2">
            We recommend a square image at least 256x256px
          </p>
          <InputError :message="form.errors.avatar" class="mt-2" />

          <SecondaryButton
              is="button"
              class="mt-2"
              type="button"
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
              @click.prevent="selectNewAvatar">
            Select A New Avatar
          </SecondaryButton>
        </div>
      </div>
    </Card>
  </form>
</template>