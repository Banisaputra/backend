import Sortable from 'sortablejs';

window.Sortable = Sortable;

const targets = document.querySelectorAll('[x-sortable]');
targets.forEach((target) => {
  Sortable.create(target, {
    animation: 250,
    ghostClass: 'bg-gray-200',
  });
});
