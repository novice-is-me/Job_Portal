<script setup>
import { ref, onMounted } from "vue";
import * as pdfjsLib from "pdfjs-dist/legacy/build/pdf";
import pdfWorkerUrl from "pdfjs-dist/legacy/build/pdf.worker.min.mjs?url";

pdfjsLib.GlobalWorkerOptions.workerSrc = pdfWorkerUrl;

const props = defineProps({
    src: { type: String, required: true },
});

const canvas = ref(null);
const pageNum = ref(1);
const totalPages = ref(0);
let pdfDoc = null;

const renderPage = async (num) => {
    const page = await pdfDoc.getPage(num);
    const viewport = page.getViewport({ scale: 1.5 });
    const ctx = canvas.value.getContext("2d");

    canvas.value.height = viewport.height;
    canvas.value.width = viewport.width;

    await page.render({ canvasContext: ctx, viewport }).promise;
};

const loadPdf = async () => {
    pdfDoc = await pdfjsLib.getDocument(props.src).promise;
    totalPages.value = pdfDoc.numPages;
    renderPage(pageNum.value);
};

const nextPage = () => {
    if (pageNum.value < totalPages.value) {
        pageNum.value++;
        renderPage(pageNum.value);
    }
};

const prevPage = () => {
    if (pageNum.value > 1) {
        pageNum.value--;
        renderPage(pageNum.value);
    }
};

onMounted(() => {
    loadPdf();
});
</script>

<template>
    <div class="w-full h-full overflow-auto">
        <canvas ref="canvas" class="max-w-full h-auto"></canvas>

        <div class="mt-2 flex justify-between">
            <button @click="prevPage" class="px-3 py-1 bg-gray-300 rounded">
                Prev
            </button>
            <span>Page {{ pageNum }} / {{ totalPages }}</span>
            <button @click="nextPage" class="px-3 py-1 bg-gray-300 rounded">
                Next
            </button>
        </div>
    </div>
</template>
