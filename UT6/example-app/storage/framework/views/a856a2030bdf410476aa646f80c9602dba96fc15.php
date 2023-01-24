
<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-blue-600 leading-tight">
            Listado de proyectos
        </h2>
     <?php $__env->endSlot(); ?>

    <?php if(session('success')): ?>
        <div class="max-w-4xl mx-auto mt-8 bg-green-700 text-white p-3 rounded-lg">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div class="overflow-x-auto mx-auto my-12 relative shadow-md sm:rounded-lg bg-white">
        <div class="p-5 bg-white flex items-center justify-center">
            <a href="<?php echo e(route('projects.create')); ?>"
                class="px-4 py-2 rounded-lg bg-blue-800 hover:opacity-80 text-white">Crear Proyecto</a>
        </div>
        <table class="w-full text-sm text-left text-gray-500 ">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        Número.
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Titulo
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Descripcion
                    </th>
                    <th scope="col" class="py-3 px-6">
                        User_id
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Category_id
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Image
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="bg-white border-b  hover:bg-gray-50 ">
                        <td class="py-4 px-6 ">
                            <?php echo e($project->id); ?>

                        </td>
                        <td class="py-4 px-6 ">
                            <?php echo e($project->name); ?>

                        </td>
                        <td class="py-4 px-6">

                            <?php echo e($project->description); ?>

                        </td>
                        <td class="py-4 px-6">
                            <?php echo e($project->user->name); ?>

                        </td>
                        <td class="py-4 px-6">
                            <?php echo e($project->category->title); ?>

                        </td>
                        <td class="py-4 px-6">
                            <?php if(Str::endsWith($project->image, 'pdf')  ): ?>
                            <a target="blank" href="<?php echo e(asset('pdf/'.$project->image)); ?>">PDF</a>
                            <?php else: ?>
                            <img class="w-[50px]" src="<?php echo e(asset('images/'.$project->image)); ?>" alt="<?php echo e($project->image); ?>">
                            <?php endif; ?>
                        </td>
                        <td class="py-4 px-5 flex items-center gap-x-2.5">
                            <a href="<?php echo e(route('projects.edit', $project->id)); ?>"
                                class="font-medium text-blue-600  hover:underline">
                                Edit
                            </a>

                            
                            <form action="<?php echo e(route('projects.destroy', $project->id)); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('delete'); ?>
                                <button type="submit" class="px-2 font-medium text-red-600  hover:underline">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <h3 class="text-2xl text-center font-bold p-5">No hay proyectos</h3>
                <?php endif; ?>
            </tbody>
        </table>

        
        <div class="p-4">
            <?php echo e($projects->links()); ?>

        </div>
    </div>


 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php /**PATH /Users/javiercabezaspena/Library/Mobile Documents/com~apple~CloudDocs/DAW/Desarrollo servidor/UT6/example-app/resources/views/projects/index.blade.php ENDPATH**/ ?>