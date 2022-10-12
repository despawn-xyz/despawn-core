<script setup>
import ProfileInformationForm from "@/Pages/Profile/Partials/ProfileInformationForm.vue";
import FullscreenModal from "@/Components/FullscreenModal.vue";
import {Tab, TabGroup, TabList, TabPanel, TabPanels} from "@headlessui/vue";
import ProfileMediaForm from "@/Pages/Profile/Partials/ProfileMediaForm.vue";
import { Head } from "@inertiajs/inertia-vue3";
</script>

<template>
  <FullscreenModal>
    <Head title="Profile Settings" />

    <div class="relative grid grid-cols-12 min-h-screen">
      <TabGroup vertical>
        <!-- aside -->
        <TabList class="col-span-2 bg-gray-900 h-full p-6 overflow-y-auto flex flex-col space-y-2">
          <Tab as="template" v-slot="{ selected }">
            <button class="py-2 px-4 hover:bg-gray-700 text-neutral-200 hover:text-white font-medium text-left w-full rounded-md"
                    :class="{ 'bg-gray-700 shadow-slim text-white': selected }">
              Overview
            </button>
          </Tab>
        </TabList>

        <TabPanels class="col-span-10 w-full max-w-4xl h-full px-6 py-16 overflow-y-scroll fixed overflow-y-scroll ml-[20rem]">
          <TabPanel class="grid gap-8">
            <!-- right side of panel -->
            <!--

            each form will be it's own card

            username email profile photo

            password

            connections

            gets too big turn into tabs?

             -->
            <ProfileMediaForm :user="$page.props.auth.user" />

            <ProfileInformationForm :user="$page.props.auth.user" />
          </TabPanel>
        </TabPanels>
      </TabGroup>
    </div>
  </FullscreenModal>
</template>