<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import {ref} from "vue";
import ConfirmationModal from "@/Components/ConfirmationModal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";

const props = defineProps({
  thread: Object,
})

const form = useForm();

const confirmingThreadDeletion = ref(false)

const confirmThreadDeletion = () => {
  confirmingThreadDeletion.value = true
}

const deleteThread = () => {
  form.delete(route('forums.thread.destroy', props.thread), {
    onSuccess: () => {
      confirmingThreadDeletion.value = false
    },
    errorBag: 'deleteThread'
  });
}
</script>

<template>
  <div>
    <DangerButton @click="confirmThreadDeletion">
      Delete Thread
    </DangerButton>

    <!-- Delete Comment Confirmation Modal -->
    <ConfirmationModal :show="confirmingThreadDeletion" @close="confirmingThreadDeletion = false">
      <template #title>
        Delete Thread
      </template>

      <template #content>
        Are you sure you want to delete this thread? Once a thread is deleted, all of its resources and data will be permanently deleted.
      </template>

      <template #footer>
        <SecondaryButton @click="confirmingThreadDeletion = false">
          Cancel
        </SecondaryButton>

        <DangerButton
            class="ml-3"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
            @click="deleteThread"
        >
          Delete Thread
        </DangerButton>
      </template>
    </ConfirmationModal>
  </div>
</template>