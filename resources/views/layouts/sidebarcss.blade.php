<style>
    /* ===================== */
    /* SIDEBAR BASE STYLING  */
    /* ===================== */
    .sidebar {
        position: fixed;
        top: 50px;
        left: -1px;
        bottom: 0;
        z-index: 1000;
        width: 140px; /* Expanded width */
        transition: width 0.3s ease;
        overflow-x: hidden;
        display: flex; 
        flex-direction: column;
        height: calc(100vh - 10px);
        background: #282c3c;
    }

    .sidebar-content {
        flex: 1;
        height: 100%;
        padding: 20px 0;
        width: 140px;
        display: flex;
        min-height: 100%;
    }

    /* ===================== */
    /* NAVIGATION STRUCTURE  */
    /* ===================== */
    .nav-sidebar {
        flex: 1;
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        width: 100%;
    }

    .nav-item {
        width: 100%;
        position: relative;
    }

    .nav-link {
        display: flex;
        align-items: center;
        padding: 12px 15px;
        color: #e6e6e6;
        text-decoration: none;
        transition: all 0.3s ease;
        position: relative;
    }

    .nav-link:hover {
        background-color: #030b22; /* Hover background */
        color: #fff;
    }

    .nav-link.active {
        background-color: #030b22; /* Active item background */
        color: #fff;
    }

    /* ===================== */
    /* ICON & TEXT STYLING   */
    /* ===================== */
    .nav-link i {
        font-size: 1.25rem;
        min-width: 24px;
        transition: all 0.3s ease;
        margin-right: 12px; /* Space between icon and text */
        text-align: center;
    }

    .nav-link span {
        white-space: nowrap;
        transition: opacity 0.2s ease, width 0.3s ease;
        overflow: hidden;
    }

    /* ===================== */
    /* COLLAPSED STATE       */
    /* ===================== */
    .sidebar:not(:hover) {
        width: 70px !important; /* Collapsed width */
    }

    .sidebar:not(:hover) .sidebar-content {
        width: 70px; /* Critical fix */
    }

    /* Center icons when collapsed */
    .sidebar:not(:hover) .nav-link {
        justify-content: center;
        padding: 12px 0;
        width: 70px;
    }

    .sidebar:not(:hover) .nav-link i {
        margin-right: 0;
        transform: translateX(3px); /* Fine-tuned centering */
    }

    .sidebar:not(:hover) .nav-link span {
        opacity: 0;
        width: 0;
    }

    /* ===================== */
    /* SCROLLBAR STYLING     */
    /* ===================== */
    .sidebar-content::-webkit-scrollbar {
        width: 5px;
    }

    .sidebar-content::-webkit-scrollbar-thumb {
        background-color: rgba(255,255,255,0.2);
        border-radius: 3px;
    }

    /* ===================== */
    /* ICON STACKING FIX */
    /* ===================== */
    .nav-link {
        display: flex;
        align-items: center;
        padding: 12px 15px;
        box-sizing: border-box; /* Include padding in width */
        width: 140px; /* Match expanded width */
        transition: all 0.3s ease;
    }

    .nav-link i {
        flex-shrink: 0; /* Prevent icon from shrinking */
    }
</style>