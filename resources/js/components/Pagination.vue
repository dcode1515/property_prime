<style lang="scss">
.pagination {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 20px;
  font-family: Arial, sans-serif;
}

.page-stats {
  margin-right: 10px;
  font-weight: bold;
  color: #333;
}

.pagination a.btn {
  color: #fff;
  background-color: #3273dc;
  border: none;
  margin: 0 5px;
  border-radius: 4px;
  padding: 8px 16px;
  text-decoration: none;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.pagination a.btn:hover {
  background-color: #245cb3;
}

.pagination a.btn.disabled {
  background-color: #ccc;
  cursor: not-allowed;
}

</style>

<template>
  <nav class="pagination" v-if="!client">
    <span class="page-stats">{{pagination.from}} - {{pagination.to}} of {{pagination.total}}</span>
    <a v-if="pagination.prevPageUrl" class="btn pagination-previous" @click="$emit('prev');">
      <i class="fa fa-chevron-left"></i> Prev
    </a>
    <a class="btn pagination-previous" v-else :class="{ disabled: !pagination.prevPageUrl }">
      <i class="fa fa-chevron-left"></i> Prev
    </a>

    <a v-if="pagination.nextPageUrl" class="btn pagination-next" @click="$emit('next');">
      Next <i class="fa fa-chevron-right"></i>
    </a>
    <a class="btn pagination-next" v-else :class="{ disabled: !pagination.nextPageUrl }">
      Next <i class="fa fa-chevron-right"></i>
    </a>
  </nav>
</template>
<script>
export default {
  props: ['pagination', 'client', 'filtered'],
};
</script>
