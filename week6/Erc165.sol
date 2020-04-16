pragma solidity ^0.6.0;

interface ERC165 {
    function supportsInterface(bytes4 interfaceID) external view returns (bool);
}

interface Simpson {
    function is2D() external returns (bool);
    function skinColor() external returns (string memory);
}

contract Homer is ERC165, Simpson {
    function supportsInterface(bytes4 interfaceID) external override view returns (bool) {
        return
          interfaceID == this.supportsInterface.selector || // ERC165
          interfaceID == this.is2D.selector
                         ^ this.skinColor.selector; // Simpson
    }

    function is2D() external override returns (bool) {}
    
    function skinColor() external override returns (string memory) {}
    
    function getIs2D() public returns(bytes4) {
        return this.is2D.selector;
    }
    function getSkinColor() public returns(bytes4) {
        return this.skinColor.selector;
    }
    
    function getSimpson() public returns(bytes4) {
        return this.is2D.selector ^ this.skinColor.selector;
    }
}
