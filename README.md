## Зв'язки N:N
- Блог ↔ мітки: таблиці `filter`, `blog_filter`; Select2 у формі запису, DualListBox на `/blog/{id}/tags`, фільтр `/blog?filter=ID`.
- Гра ↔ платформа: таблиці `platforms`, `game_platform` (складений ключ `game_id` + `platform_id`); вибір платформ через Select2 у формі гри; кількість платформ (`withCount`) у переліку; `/platforms` показує кількість ігор.
