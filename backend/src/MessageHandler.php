<?php

class MessageHandler
{
    private $userId;
    private $username;
    private $number;

    public function __construct($userId, $username, $number)
    {
        $this->userId = $userId;
        $this->username = $username;
        $this->number = $number;
    }

    public function getFunnyMessage()
    {
        // Check for special cases
        if ($this->number === (int)$this->username) {
            return "Your number matches your username! Are you not very creative? 😄";
        }

        // Check for common funny numbers and patterns
        switch ($this->number) {
            case 42:
                return "The answer to life, the universe, and everything! 🌌";
            case 69:
                return "Nice! 😏";
            case 420:
                return "Blaze it! 🔥";
            case 666:
                return "Someone's feeling devilish today! 😈";
            case 1337:
                return "L33t choice! You must be a pro gamer! 🎮";
            case 88:
                return "A lucky number in Chinese culture! 🎰";
            case 404:
                return "Number not found! (Just kidding, it's right here) 🔍";
            case 777:
                return "Jackpot! Triple lucky sevens! 🎰";
            case 12345:
                return "That's amazing! I've got the same combination on my luggage! 🧳";
            case 123:
                return "As easy as 1-2-3! 🎵";
            case 911:
                return "Is everything okay? Need help? 🚨";
            case 007:
                return "Bond. James Bond. 🕴️";
            case 314:
            case 3141:
            case 31415:
                return "Mmm... π looks delicious! 🥧";
            case 101:
                return "Programming basics! 💻";
            case 1000:
                return "That's grand! 🎉";
            case 2000:
                return "Y2K bug free! 🐛";
            case 99:
                return "99 problems but a number ain't one! 🎵";
            case 13:
                return "Feeling brave with that unlucky number! 🍀";
            case 24:
                return "24/7, always on! ⏰";
        }

        // Check for patterns
        $numStr = strval($this->number);

        // Only check palindromes for numbers with 2 or more digits
        if (strlen($numStr) > 1 && $numStr === strrev($numStr)) {
            return "Ooh, a palindrome! Very satisfying! 🔄";
        }

        // Perfect square check
        if (sqrt($this->number) == floor(sqrt($this->number))) {
            return "Perfect square! You're so well-rounded! ⬛";
        }

        // Check for repeating digits
        if (preg_match('/^(\d)\1+$/', $numStr)) {
            return "All the same digits! You like consistency! 🎯";
        }

        // Check for ascending sequence
        if (preg_match('/^123456789/', $numStr)) {
            return "Counting up! Someone paid attention in math class! 📚";
        }

        // Check for descending sequence
        if (preg_match('/^987654321/', $numStr)) {
            return "Counting down! Ready for takeoff! 🚀";
        }

        // Check if all digits add up to 7 (lucky number)
        if (array_sum(str_split($numStr)) == 7) {
            return "Your digits sum to 7! Lucky you! 🍀";
        }

        // Number ends with multiple zeros
        if (preg_match('/00$/', $numStr)) {
            return "Look at all those zeros! Rolling in style! 💫";
        }

        // Over 9000!
        if ($this->number > 1000000) {
            return "It's Over 9000!!!! 🚀";
        }

        // Negative numbers
        if ($this->number < 0) {
            return "Going negative! Glass half empty kind of person? 🥛";
        }

        return null;
    }
}
