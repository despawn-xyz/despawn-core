<script setup>
import { TransitionRoot, TransitionChild, Dialog, DialogPanel } from '@headlessui/vue'
import { useModal } from 'momentum-modal'
import { XCircleIcon } from '@heroicons/vue/24/outline'

const { show, close, redirect } = useModal()
</script>

<template>
  <TransitionRoot appear as="template" :show="show">
    <Dialog as="div" class="relative z-[9999]" @close="close">
      <TransitionChild
          @after-leave="redirect"
          as="template"
          enter="duration-200 ease-out"
          enter-from="opacity-0"
          enter-to="opacity-100"
          leave="duration-200 ease-in"
          leave-from="opacity-100"
          leave-to="opacity-0">
        <div class="fixed inset-0 bg-black/75 transition-opacity" />
      </TransitionChild>

      <div class="fixed inset-0">
        <div class="flex min-h-full items-center justify-center text-center">
          <TransitionChild
              as="template"
              enter="duration-200 ease-out"
              enter-from="opacity-0 scale-105"
              enter-to="opacity-100 scale-100"
              leave="duration-200 ease-in"
              leave-from="opacity-100 scale-100"
              leave-to="opacity-0 scale-105">
            <DialogPanel class="relative w-full min-h-screen transform bg-gray-800 text-left align-middle shadow-xl transition-all">
              <button class="absolute z-50 top-0 right-0 mt-16 mr-[30rem]" @click="close">
                <XCircleIcon class="text-gray-200 h-16 w-16 [&>path]:stroke-[1]" />
              </button>
              <slot />
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>