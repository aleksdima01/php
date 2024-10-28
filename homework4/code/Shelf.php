<?php


class Shelf
{
    private int $shelfId;
    private Room $room;
    private int $volume;
    public function __construct(int $shelfId, Room $room, int $volume)
    {
        $this->shelfId = $shelfId;
        $this->room = $room;
        $this->volume = $volume;
    }
    public function __toString()
    {
        return "Шкаф № $this->shelfId в комнате $this->room.";
    }
}
