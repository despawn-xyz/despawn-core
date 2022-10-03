<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Container from "@/Components/Container.vue";
import Card from "@/Components/Card/Card.vue";
import CardHeader from "@/Components/Card/CardHeader.vue";
import { ChatBubbleLeftEllipsisIcon } from "@heroicons/vue/24/outline"
import Cover from "@/Components/Cover.vue";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
})
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Welcome" />

    <Cover image="https://cdn.noclip.gg/Bxb0m98FxeYTnOpY/Rkbu_Fj_0ubnYp44mEgS4MocO0qR_m4c.jpg" />

    <Container class="relative z-10">
      <div class="w-full max-w-full px-6 py-32 text-center space-y-4">
        <img class="object-contain select-none pointer-events-none m-auto w-32 h-32 rounded" src="https://cdn.noclip.gg/ZwrHIowmadgLm2pr/oZq4yj6CzV6h5hl8FdCJpde0-xu-X8Fg.png" alt="kings" loading="lazy">
        <h1 class="text-3xl font-bold text-neutral-50 break-words">
          Welcome to King's Gaming
        </h1>

        <p class="text-neutral-200 break-words">
          A very cool and epic community
        </p>
      </div>
    </Container>

    <Container>
      <div class="w-full grid grid-cols-12">
        <div class="w-full col-span-12 md:col-span-8">
          <Card>
            <CardHeader>
              <div class="relative flex flex-col z-10">
                <h4 class="text-neutral-50 text-lg font-medium">Official</h4>
                <p class="text-neutral-200 text-sm">Official forums dedicated to announcements, news, information, and feedback.</p>
              </div>
            </CardHeader>

            <div class="relative overflow-hidden grid grid-cols-6 md:grid-cols-12 auto-cols-max">
              <div class="col-span-1 flex items-center justify-center p-2">
                <div class="h-10 w-10 bg-primary-500/10 flex items-center justify-center rounded-full">
                  <ChatBubbleLeftEllipsisIcon class="text-primary-500 h-5 w-5" />
                </div>
              </div>

              <div class="col-span-3 md:col-span-7 flex flex-col items-start justify-center p-2">
                <Link href="/forums/board/announcements" class="font-medium text-neutral-50">
                  Announcements
                </Link>
                <p class="text-neutral-200 truncate w-full">
                  Very cool, fuck you
                </p>
              </div>

              <div class="hidden md:flex col-span-1 flex-col items-center justify-center p-2 text-center">
                <p class="font-medium text-primary-500">
                  2
                </p>
                <h6 class="text-neutral-400">
                  Threads
                </h6>
              </div>

              <div class="hidden md:flex col-span-1 flex-col items-center justify-center p-2 text-center">
                <p class="font-medium text-primary-500">
                  7
                </p>
                <h6 class="text-neutral-400">
                  Replies
                </h6>
              </div>

              <div class="col-span-2 md:ol-span-2 flex items-center justify-start p-2 overflow-hidden">
                <img loading="lazy" class="object-cover select-none pointer-events-none rounded-full absolute -right-6 h-32 w-32 opacity-10" url="https://cdn.noclip.gg/zJSb9cD3TC1w8F66/YHSjkKuvFMSvpfWdOfyDDTHEgnXuJW-metaMmQ0NWYzYWJhNTg3YjIwYjFmZmZkMGIzMjBlNjc5NzcuanBn-.jpg" alt="pontifex" src="https://cdn.noclip.gg/zJSb9cD3TC1w8F66/YHSjkKuvFMSvpfWdOfyDDTHEgnXuJW-metaMmQ0NWYzYWJhNTg3YjIwYjFmZmZkMGIzMjBlNjc5NzcuanBn-.jpg">

              </div>
            </div>
          </Card>
        </div>
      </div>
    </Container>
  </AuthenticatedLayout>
</template>
