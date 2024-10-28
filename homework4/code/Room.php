<?php



class Room
{
    private int $roomId;
    private string $adress;
    public function __construct(int $roomId, string $adress)
    {
        $this->roomId = $roomId;
        $this->adress = $adress;
    }
    public function __toString()
    {
        return $this->roomId;
    }
}
