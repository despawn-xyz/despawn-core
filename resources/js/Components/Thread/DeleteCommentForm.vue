<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import {ref} from "vue";
import ConfirmationModal from "@/Components/ConfirmationModal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";

const props = defineProps({
  comment: Object,
})

const form = useForm();

const confirmingCommentDeletion = ref(false)

const confirmCommentDeletion = () => {
  confirmingCommentDeletion.value = true
}

const deleteComment = () => {
  form.delete(route('forums.comment.destroy', props.comment), {
    onSuccess: () => {
      confirmingCommentDeletion.value = false
    },
    errorBag: 'deleteComment'
  });
}
</script>

<template>
  <div>
    <DangerButton @click="confirmCommentDeletion">
      Delete Comment
    </DangerButton>

    <!-- Delete Comment Confirmation Modal -->
    <ConfirmationModal :show="confirmingCommentDeletion" @close="confirmingCommentDeletion = false">
      <template #title>
        Delete Comment
      </template>

      <template #content>
        Are you sure you want to delete this comment? Once a comment is deleted, all of its resources and data will be permanently deleted.
      </template>

      <template #footer>
        <SecondaryButton @click="confirmingCommentDeletion = false">
          Cancel
        </SecondaryButton>

        <DangerButton
            class="ml-3"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
            @click="deleteComment"
        >
          Delete Comment
        </DangerButton>
      </template>
    </ConfirmationModal>
  </div>
</template>